---
title: 'Evolving PHP Streams for Async, Security, and Performance'
layout: post
tags:
  - development
author:
  - name: Jakub Zelenka
    url: https://github.com/bukka

published_at: 30 October 2025

---

Thanks to investment from the Sovereign Tech Agency (STA), a German government backed organization supporting open-source infrastructure, the PHP Foundation is modernizing one of PHP’s oldest and most critical subsystems: Streams.

This post outlines the planned work and explains why these changes matter for the PHP ecosystem.

## What Are PHP Streams?

Before diving into the improvements, let’s briefly revisit what Streams are and why they matter.

Introduced around 2001, PHP streams provide a unified way to handle file and network I/O, allowing data from different sources such as files, sockets, or memory to be accessed through a consistent API using the same set of functions.

Over time, PHP streams have proven to be a powerful and flexible subsystem, but some parts of the implementation have not evolved alongside modern use cases, performance expectations, and system capabilities. This project aims to make Streams faster, safer, and easier to extend for modern PHP applications.

The actual scope is divided into four subsections.

## Performance and Stability improvements

This part aims to improve performance and consistency in how PHP Streams copying and seeking.

There is still room to improve performance in stream copying. 

For example, copying large files or handling network transfers can be made faster through asynchronous I/O mechanisms like io_uring on Linux. At the same time, we need to prevent potential crashes caused by memory-mapped files. The goal is to phase out mmap usage and introduce a new copying API as part of the upcoming I/O API, using io_uring or other system features where available.

Seeking is currently problematic for filtered streams, which causes various inconsistencies. Developers working with filters often encounter limitations when rewinding or skipping data.

The plan is to introduce a new seeking filter API that will allow seeking in streams where possible and disallow it where not. For example, seeking to the beginning should always be possible, but not all filters support seeking to arbitrary positions. Some may allow it, so a new internal API is needed.

## Error Handling and Monitoring Enhancements

This part is mainly about the introduction of new error reporting mechanisms for streams as well as the introduction of more hooks. Currently, many low-level I/O errors are surfaced inconsistently to user space. The goal is to standardize how Streams report errors and make them easier to debug.

The primary idea for error reporting is to have a better way to handle errors so they can be collected and reported to user space. We’ll wrap existing errors and provide richer context options for developers.

In terms of hooks, this would be useful for async code and could be done through a special polling wrapper. There should be some way to allow replacing some blocking operations (specifically for file IO). This is primarily meant as an internal change, but it will also be considered to possibly expose some hooks to user space if convenient and acceptable from a performance point of view.

## Networking and Socket Improvements

This part is mainly about the introduction of a new polling API, improvements in the stream_select function, and resolving issues in socket handling.

Modern network applications rely heavily on scalable event handling. The new polling API will introduce modern mechanisms such as epoll and kqueue, enabling PHP to handle multiple I/O streams more efficiently.

Currently, only select is available for user space, which has known performance and scaling issues. This modernization will benefit frameworks and extensions that implement async networking or event-driven I/O.

The purpose of the API is primarily to build an internal API that can be used internally for various tasks in the PHP core and as a base (fallback) for the future async IO API.

The stream_select usage should be extended to better handle polling of filtered streams and provide an API for external objects that can provide extra data, as will be possible in the new polling API. This will require some refactoring and potentially sharing some of the logic with the new polling API.

Additionally, several socket-specific improvements are planned. New socket context options will be added to provide better configuration capabilities. Various socket handling issues will be addressed, and utilities for working with file descriptors will be improved.

## Security and TLS Enhancements

Another important part of this work targets the OpenSSL extension, which handles encrypted streams.

Specifically, refactoring its async handling that is currently not well implemented and has various limitations. The refactoring will clarify what polling action is required for user space. For example, whether the stream needs to wait for reading or writing.

In addition, we aim to improve TLS 1.3 support with options to select cipher suites and integrate TLS Sessions, PSK (Pre-Shared Key) and early data (0-RTT) support.

To enable these changes, a new TLS 1.3 PHP testing library is being developed. It will allow customizing the protocol flow and testing TLS 1.3 features, including asynchronous behavior.

## Next Steps

Together, these efforts will modernize and strengthen PHP’s I/O layer for the next decade of web and CLI development.

Work has started in 2025 and will go through 2026. Incremental progress will be shared publicly through PHP Foundation updates and PHP internals discussions, and RFCs.

We’re grateful to the Sovereign Tech Agency for supporting this foundational investment in PHP’s core. Stay tuned for technical write-ups and benchmarks as the implementation progresses.
