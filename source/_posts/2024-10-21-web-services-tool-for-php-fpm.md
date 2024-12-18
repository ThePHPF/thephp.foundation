---
title: 'Introducing Web&nbsp;Services&nbsp;Tool for&nbsp;PHP-FPM'
layout: post
tags:
  - news
author:
  - name: Jakub Zelenka
    url: https://github.com/bukka
published_at: 21 October 2024

---

The Web Services Tool (WST) is a command-line application developed to test PHP-FPM, [**commissioned by the Sovereign Tech Fund**](https://www.sovereigntechfund.de/tech/php) (STF). Its primary goal is to facilitate testing of the integration between different web servers and PHP-FPM across various environments and configurations.

This blog post provides an introduction to the tool. We'll go through the history of PHP-FPM testing and the reasons that led to WST's development. The post also outlines the project structure, insights into the tool’s architecture, its current state, and the roadmap for future development.

## PHP-FPM testing and WST history

### First steps

PHP-FPM was initially developed as a patch series starting around 2004. It evolved into a more modular architecture with a separate SAPI by 2009, and it was [merged into the PHP core](https://github.com/php/php-src/commit/06b9943842eb954025ac83b542e97d6310aa524a) in 2010. It was declared stable with the release of PHP 5.4 in 2011. While this version introduced many features that are still used today, it did not include any automated tests; all testing was done manually.

The first automated test was introduced in early 2014, and it provided a basic check to verify that PHP-FPM can start with a certain configuration. Later that year, more advanced tests were added, including a FastCGI client, which allowed PHP-FPM to run in a separate process, accept FastCGI requests, and return responses. This was a major step forward, as it enabled testing scenarios that weren't previously possible. However, the implementation was more of a workaround, piecing together different components. The tests were repetitive and limited in their ability to define complex expectations.

### A bit more, but still not enough

In 2018, I [carried out](https://github.com/php/php-src/commit/ea592e6b6c43b7c5ebedf63254b8088f741e276c) a complete rewrite of the FPM tests, introducing a primary `Tester` class. This class integrated more robust expectations and added abstractions for handling requests and responses. Over the years, this framework has been improved and now includes many features that support testing more complex scenarios. It significantly improves test code re-usability and offers various new options for easier testing. However, it **doesn’t cover integration tests with web servers**, which often have quirks not easily caught by these tests. Additionally, this framework **doesn't handle high-load scenarios**, which are necessary for testing process management in PHP-FPM. **This showed the need for a new tool to keep PHP-FPM development safe.**

### Here comes The PHP Foundation and the STF service agreement

Initially, I had an idea to extend [fpmt](https://github.com/bukka/fpmt), my tool for testing PHP-FPM (specifically for sending custom FastCGI requests), and integrate most of the testing logic directly into it. However, it soon became clear that maintaining such a tool would require constant code changes, and the effort needed to build and sustain it was too large. As a result, I put the project on hold.

It wasn’t until 2023 that the idea resurfaced, thanks to an opportunity provided by the Sovereign Tech Fund. The STF gave PHP projects a chance to propose initiatives aimed at improving their overall health. Testing, being a critical component of project health, made this tool a perfect candidate, and it, along with [three other projects](https://www.sovereigntechfund.de/tech/php#what-are-we-funding), comprised the scope of work commissioned by the STF.

### How WST started
I began the work on the tool in January 2024 with the planning phase. It quickly became evident that a more generic approach would offer greater flexibility and cover more use cases. I decided to design the tool around a clear configuration structure, which would be parsed and executed. A key part of the planning was ensuring that the **same tests could run both locally and in containers**, with an option to simulate high loads by integrating with a load testing tool. Given these requirements, I chose Go as the implementation language, as it provides well-supported clients and packages for all the project’s needs. Go's advanced templating capabilities, which are popular in tools like Helm, were also a deciding factor.

For easier setup, the project was organized under a new [**wstool**](https://github.com/wstool/) organization, containing two repositories: one for the actual tool implementation ([wst](https://github.com/wstool/wst)) and another for the PHP-FPM testing configurations ([wst-php-fpm](https://github.com/wstool/wst-php-fpm)). The structure of the application differs slightly from typical Go applications, as it focuses on achieving full test coverage for most components. As a result, it features multiple sub-packages to allow for the creation of mocks using [Go Mockery](https://github.com/vektra/mockery), which generates [Testify](https://github.com/stretchr/testify) mocks.

## The current state and its structure

The tool has been developed into a functional state that allows it to run various tests. Its architecture is defined by its configuration, with a strong emphasis on flexibility.

At the core of the configuration is a file that contains a specification composed of settings for various components. Multiple configuration files can be specified, along with specific overrides for selected values. These configurations and overrides are then merged into a single, unified configuration. Example of execution could look like:

```shell
wst -f /path/to/cfg1 -f /path/to/cfg2 -o spec.defaults.service.sandbox=docker
```

This will merge cfg1 and cfg2 and apply overwrite for the default server.  
The final configuration defines environments, sandboxes, servers, and instances – these are the core elements of the application’s execution. Additionally, it defines some default settings, including base parameters. These parameters allow for further customization and can be accessed within template files and strings. The example of primary configuration looks like

```yaml
version: "0.1"
name: FPM
description: FPM server specifications for testing PHP-FPM
spec:
  environments: environments.yaml
  instances: spec/instances/*.yaml
  sandboxes: sandboxes.yaml
  servers: servers/*/*/server.yaml
  workspace: workspace/
  defaults:
    service:
      sandbox: local
    parameters:
      fpm_binary: php-fpm
```

As you can see, it is possible to separate config to multiple files that can be specified in the wildcard format. The meaning of primary spec parts is following:

* **Environments** specify where the tests are executed, allowing for tests to run locally, in Docker, or Kubernetes environments. This enables testing across different distributions using Docker and under production-like loads with Kubernetes. Such flexibility helps recreate reported issues more effectively, as some problems only appear under heavy load. It also provides greater confidence when implementing new features or fixing complex bugs.
 
* **Sandboxes** are closely related to environments, defining how services behave in each environment. Specifically, they define hooks containing commands or signals for starting, stopping, reloading, and restarting services.
   
* **Servers** contain the specifications of the web servers or other web services being tested. They define server configuration templates, expectations, parameters, and specific hooks linked to sandboxes. For instance, a server might specify PHP-FPM configuration files (fpm.conf, php.ini), set up start hooks for the PHP-FPM binary with selected parameters, and outline specific log message expectations following PHP-FPM startup. These predefined settings help reduce code duplication.
  
* **Instances** are the core of WST’s testing functionality. They define everything specific to a single test case, primarily specifying the service. This means choosing the server by name, providing parameters, and specifying configuration files to be included with the selected parameters. They also define scripts included in the services and their content, which are then utilized during actions.

The mentioned actions offer additional flexibility by providing a custom mini pipeline which offers a high degree of flexibility. Actions are responsible for controlling services (start, stop, restart, reload), triggering requests (request, bench), and setting expectations on output (logs), responses (for requests), and metrics (for benchmarks). There is also a parallel action, allowing multiple actions to run simultaneously

This is an example of a simple instance with actions:

```yaml
version: "0.1"
name: FPM
description: FPM server specifications for testing PHP-FPM
spec:
  environments: environments.yaml
  instances: spec/instances/*.yaml
  sandboxes: sandboxes.yaml
  servers: servers/*/*/server.yaml
  workspace: workspace/
  defaults:
    service:
      sandbox: local
    parameters:
      fpm_binary: php-fpm
```

This test starts FPM and `httpd` with selected configs, sends a request for `index.php` path, verifies that response body and stops the servers.

Currently, the tool works in a local environment and has already helped recreate complex scoreboard locking issues through its automated load testing (bench action). The Docker and Kubernetes environments have largely been finalized in terms of structure, with most of the implementation in place. However, some additional changes and fixes are needed for full functionality.

## The first results

The initial PHP-FPM configuration includes only a few instances and server configurations. It defines three servers—fpm, nginx, and httpd (Apache). These servers contain default configurations with all necessary settings, as well as variants for Debian and RedHat that could be used as needed. The servers also define reusable expectations across instances. For PHP-FPM, these expectations are used to verify that the server has started successfully, based on log messages, and include templates for asserting FPM status responses.

As for instances, there are currently the following tests defined:

* [Access log path suppression test](https://github.com/wstool/wst-php-fpm/blob/bccec57f02e7918aedf5bce43387a3c1ce733f37/spec/instances/access-suppress-path-status.yaml) \- It verifies access logs, which uses status checking and output verification to ensure that access logs are properly generated in both PHP-FPM and Nginx.
* [Apache httpd mod\_proxy\_fcgi SetHandler basic tests](https://github.com/wstool/wst-php-fpm/blob/bccec57f02e7918aedf5bce43387a3c1ce733f37/spec/instances/httpd-proxy-fcgi-handler-basic.yaml) \- It tests FastCGI integration between Apache httpd and PHP-FPM and makes sure that different combinations of test works. It also recreates a recent issue with Apache httpd integration.
* [Scoreboard atomic copying test](https://github.com/wstool/wst-php-fpm/blob/bccec57f02e7918aedf5bce43387a3c1ce733f37/spec/instances/scoreboard-atomic-copy.yaml) \- It focuses on testing the scoreboard under higher loads. This test has been particularly useful in reliably reproducing a scoreboard locking issue, which has been causing errors for users. Once the issue is resolved, the test will serve as a regression check to ensure the problem doesn’t reoccur.

## The future development

The primary goal moving forward is to add more tests and begin using the tool to address existing complex issues and features in PHP-FPM. This will require further updates to the application to improve its capabilities. The tool also needs to be stabilized and made more user-friendly, specifically, enhancing logging and documentation.

Once the tool and PHP-FPM tests reach a stable state, the next step would be to set up a continuous integration (CI) system to run all stable tests regularly against the latest repository. Ideally, this could be integrated into PHP’s nightly workflow. There is a possibility to use higher spec resources from TeamCity or infrastructure provided by AWS to PHP Foundation which is currently used for benchmarking project testing performance of PHP.

Since the tool is not specific to PHP-FPM, it could also be applied to other parts of PHP. For example, it could finally enable tests for the Apache handler (`mod_php`) SAPI, which is still widely used but currently lacks testing, making changes risky. Additionally, the tool could be useful for testing specific scenarios involving PHP extensions that rely on external services, such as databases or LDAP.

Another area where the tool could be valuable is in performing various security-related tests. Adding fuzzing capabilities could help uncover a range of issues, including potential security vulnerabilities, not only in PHP-FPM but also in the web servers themselves.

Testing full framework applications and automating setup steps like `composer install` could improve the tool as well. This will require more time and help from the community to make sure the setups are reliable in all environments.

## Summary

The WST has already proven to be valuable for PHP-FPM development and testing, because it helps address  complex issues which were never tested in automated way before.

As more features and tests are added, its importance will only grow. We hope it will become an essential part of ensuring PHP-FPM's stability, performance, and evolution.

💜️ 🐘
