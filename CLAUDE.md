# CLAUDE.md

This is the source code for thephp.foundation website, built with Sculpin (PHP static-site generator) and Tailwind CSS.

## Requirements

- PHP 8.3+ with extensions: gd, dom
- Composer
- Node 20 with NPM

## Installation

```bash
composer install
npm install
```

## Development Commands

### Build CSS (required before first run)

```bash
npx tailwind -i assets/css/app.css -o source/assets/css/app.css
```

### Start development server

```bash
composer run npx-watch & composer run sculpin-watch
```

Server runs at http://localhost:8000

## Project Structure

- `source/_pages/` - Static pages with fixed permalinks
- `source/_posts/` - Blog posts (format: `YYYY-MM-DD-title.md`)
- `source/assets/` - Static assets
- `assets/css/app.css` - Primary CSS source file
- `app/src/` - PHP application code (PSR-4: `App\`)

## Content

### Blog post format

```markdown
---
title: Post title
layout: post
tags:
    - update
author:
  name: Author name
  url: https://author-url.com
---
Content in Markdown
```

## Deployment

Auto-deploys to gh-pages on push to main branch via GitHub Actions.
