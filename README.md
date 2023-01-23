# URI Modern News

URI Modern News is a WordPress theme designed for the University of Rhode Island news site. It is a child theme of URI Modern.

## What's new in v2.0

URI Modern News v2.0 is a major release focused on cleaning up custom fields and supporting the News Enterprise launch.

- Reconciles custom fields in the theme with ones present on the News site
  - Adds horizontal and vertical image fields
  - Adds a homepage display format field
  - Renames the short headline field to "Alternate headline"
  - Uses the appropriate slug for first and last name fields
  - Uses category slugs instead of ids
  - Renames the deck field to "Subhead"
  - Removes nutshell and square image fields
  - Removes the sticky order field in favor of using subcategories to display featured posts
- Uses the first and last name fields in Media Contacts for display on News posts, instead of the Media Contacts post title
- Adds new styles for News post meta data
- Fixes an issue that prevented compatibility with the [Component Library](https://github.com/uriweb/uri-component-library) display posts filters
- Updates development tools

For complete details, see the [commit history](https://github.com/uriweb/uri-modern-news/pull/25/commits) and the [issue tracker](https://github.com/uriweb/uri-modern-news/issues).

## How do I get set up?

1. Make sure you have [URI Modern](https://github.com/uriweb/uri-modern) installed first
2. Grab a copy of the [latest version](https://github.com/uriweb/uri-modern-news/releases/latest) of URI Modern News
3. Install it into your WordPress `wp-content/themes` directory
4. Activate it as your site's theme
5. Configure it with Customizer

Contributors: Brandon Fuller, John Pennypacker  
Tags: themes  
Requires at least: 4.0  
Tested up to: 6.1  
Stable tag: 2.1  
