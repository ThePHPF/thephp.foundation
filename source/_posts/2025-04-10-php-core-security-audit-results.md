---
title: 'PHP Core Security Audit Results'
layout: post
tags:
  - news
author:
  - name: Roman Pronskiy
    url: https://twitter.com/pronskiy
published_at: 10 April 2025
---

The PHP Foundation is pleased to announce the completion of a comprehensive security audit of the PHP source code ([php/php-src](https://github.com/php/php-src)), **commissioned by the [Sovereign Tech Agency](https://www.sovereign.tech/)**.

This initiative was organized in partnership with the [Open Source Technology Improvement Fund](https://ostif.org/) (OSTIF) and executed by the esteemed security group [Quarkslab](https://www.quarkslab.com/).

## Audit Overview

Conducted over a two-month period in 2024, the audit encompassed:

* Development of a threat model tailored to php-src
* Manual code reviews
* Dynamic testing procedures
* Cryptographic assessments

The collaboration between Quarkslab’s auditors and PHP maintainers ensured a thorough examination of the codebase.

> _⚠️_   
Due to budget constraints, the recent security audit focused on the most critical components of the PHP source code rather than the entire codebase. Organizations interested in sponsoring a comprehensive audit or additional assessments are encouraged to [contact us](mailto:contact@thephp.foundation)!  
> _⚠️_

## Key Findings

The audit identified 27 issues, with 17 having security implications:

* 3 High-severity
* 5 Medium-severity
* 9 Low-severity

Additionally, 10 informational findings were reported.

Notably, four vulnerabilities received CVE identifiers:

* CVE-2024-9026: Log tampering vulnerability in PHP-FPM, allowing potential manipulation or removal of characters from log messages.
* CVE-2024-8925: Flaw in PHP’s multipart form data parsing, potentially leading to data misinterpretation.
* CVE-2024-8929: Issue where a malicious MySQL server could cause the client to disclose heap content from other SQL requests.

## Recommendations and Resolutions

Quarkslab’s report commended the overall high quality and specification adherence of the php/php-src project.

The PHP development team has addressed all identified issues. Users are strongly encouraged to upgrade to the latest PHP versions to benefit from these security enhancements.

## Acknowledgments

We extend our gratitude to the individuals and organizations that made this audit possible:

* **The PHP Foundation Team and PHP maintainers:**   
  Jakub Zelenka, Arnaud Le Blanc, Niels Dossche, Ilija Tovilo, Stas Malyshev, Dmitry Stogov, Derick&nbsp;Rethans, and Roman Pronskiy.
* **Quarkslab Team:**  
  Angèle Bossuat, Julio Loayza Meneses, Mihail Kirov, Sebastien Rolland, Ramtine Tofighi Shirazi.
* **Sovereign Tech Agency:**  
  Abigail Garner and the team – for commissioning the audit and all the help.
* **OSTIF:**   
  Amir Montazery, Derek Zimmer, Helen Woeste – for organizing the collaboration.

This audit underscores our commitment to enhancing PHP’s security and reliability. We remain dedicated to ongoing improvements and collaborations to ensure PHP’s robustness for the global development community.

## Further Reading

* [Audit Report](/assets/files/24-07-1730-REP-V1.4_temp.pdf)
* [OSTIF Blog](https://ostif.org/php-audit-complete/)
* [Quarkslab Blog](https://blog.quarkslab.com/security-audit-of-php-src.html)

If your company is interested in commissioning another round of security audit, please contact The PHP Foundation team: [contact@thephp.foundation](mailto:contact@thephp.foundation).

🐘💜
