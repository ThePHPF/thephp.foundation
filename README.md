# thephp.foundation website
blabla pour la mairie de mon quartier j'ai fait avec hjosé gaydu etc

This is the source code for the website of [thephp.foundation](https://thephp.foundation).
It is built using the PHP static-site generator [Sculpin](https://sculpin.io), and uses [Tailwind CSS](https://tailwindcss.com) for design and layout.

## Submitting blog posts

To submit a blog post, create a pull request, adding a new file under `source/_posts/` in the format `{4-digit Year}-{2-digit Month}-{2-digit Day}-{dash-separated title}.md`.
All posts are written using Markdown with frontmatter YAML, and should have the following general format:

```markdown
---
title: Title for the post
layout: post
tags:
    - update
author:
  name: Your name
  url: A URL with information on you
---
Markdown content starts here
```

## Developing/maintaining the site

The site

### Requirements

To develop the website, you will need:

- PHP 7.3 or later
- Composer
- Node 14 or 16 with NPM

### Installing dependencies

Install PHP dependencies using Composer:

```bash
$ composer install
```

Install CSS dependencies using NPM:

```bash
$ npm install
```

### Build the CSS

The site CSS is intentionally omitted from the source tree, as it is built using Tailwind from HTML classes.
As such, you will need to build the CSS before initial testing:

```bash
$ npx tailwind -i assets/css/app.css -o source/assets/css/app.css
```

### Testing the site

### Content changes

You can start the Sculpin development server using the following within a terminal:

```bash
$ ./vendor/bin/sculpin generate --watch --server
```

This will launch the server at https://localhost:8000

As you make content changes and save them, the server will regenerate pages automatically, allowing you to preview in your browser.

When done, press `Ctrl-C`.

### CSS/Design changes

If you are making any design changes, including adding HTML class attributes, you should run the Tailwind watcher; this ensures a page refresh will pick up any CSS changes.
Invoke the watcher in a terminal as follows:

```bash
$ npx tailwind -i assets/css/app.css -o source/assets/css/app.css --watch
```

When done, press `Ctrl-C`.

The primary CSS file is kept in `assets/css/app.css`, and contains a number of overrides for common HTML tags; this is done so that rendered Markdown can remain styled.
All other styles are derived from CSS classes; see the [Tailwind CSS documentation](https://tailwindcss.com/docs/installation) for details on what classes you can compose to achieve different design goals.

### Content Types

This site has two Sculpin content types:

- pages (under `source/_pages/`)
- posts (under `source/_posts/`)

Pages are one-off pages with a static permalink.

Posts are blog posts, and will show up on the `/blog` page as well as in the site feed.

### Top-level pages

The site defines two top-level pages:

- `index.html`: The site landing page.
- `blog.html`: The blog landing page.

## Deployment

The [deployment workflow](.github/workflows/deploy-site.yml) auto-deploys to gh-pages on a push to the main branch.
