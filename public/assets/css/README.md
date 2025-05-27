# CSS Structure for Łowisko Lipuś

## Overview

This document describes the CSS organization for the Łowisko Lipuś website. We've implemented a more modular approach to CSS to improve maintainability and performance.

## File Structure

- `style.css` - Original CSS file (very large, ~1900 lines)
- `main.css` - New modular CSS file with imports (generated)
- `admin.css` - Dedicated styles for admin panel and login
- `components/` - Directory containing individual CSS modules

## Why We Made These Changes

1. **Improved Maintainability**: Breaking down the large style.css file into smaller components makes it easier to find and modify specific styles.
2. **Better Organization**: Styles are now grouped by functionality.
3. **Faster Load Times**: Using component imports allows browsers to cache individual files, improving performance.
4. **Separation of Concerns**: Admin styles are now separate from front-end styles.

## Admin Interface Updates

We've created a dedicated `admin.css` file to improve the admin interface:

1. **Login Page**: Enhanced with clearer layout, better contrast, and improved form elements
2. **Admin Panel**: Reorganized with more consistent spacing, improved typography, and better responsiveness
3. **Visual Hierarchy**: Added icons and better visual cues to improve usability

## CSS Splitting Tool

We've included a tool to help split the large style.css file into modular components:

```bash
node tools/css-splitter.js
```

This script:
1. Reads the style.css file
2. Splits it into sections based on comments
3. Creates individual component files
4. Generates a main.css file with imports

## How to Use

For the front-end site:
```html
<link rel="stylesheet" href="/assets/css/main.css">
```

For admin pages:
```html
<link rel="stylesheet" href="/assets/css/admin.css">
```

## Additional Notes

- The original style.css file is kept for reference
- The admin.css file is completely independent and doesn't require style.css
- Each component file can be individually edited without affecting the entire system 