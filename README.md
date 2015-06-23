# multiple-wysiwygs-per-page

## Description

This plugin places arbitarily many full TinyMCE windows in the post editor for Pages. The intent is to allow multiple sections with full-width backgrounds -- as used in, for example, parallax themes -- without sacrificing the user experience.

## Notes and Gotchas

* For this to work, you'll need to [include CMB2](https://github.com/WebDevStudios/CMB2/) -- the full, unzipped folder -- inside the same folder as wpshout-page-sections.php is in.

wpshout-page-sections.php is the plugin's only active file. The other files are demos to show how the plugin interfaces with a theme.

* sample-template-file.php is only here as a demo. The plugin doesn't use it directly.

It shows you how the custom TinyMCE boxes are implemented in a theme's template file (such as page.php). To get the additional MCE windows to show up on your site's front end, you'll need to add the same types of get_post_meta() calls to your own theme template files.

* sample-sections-styles.css is only here as a demo. The plugin doesn't use it directly.

It shows you how the sections are currently being styled -- so that their background colors are full-width, but the content is not -- in the demo on WPShout.