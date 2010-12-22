SilverStripe Holding Page Module
================================

Maintainer Contacts
-------------------
*  Frank Mullenger (frankmullenger_AT_gmail(dot)com)
   [My Blog](http://deadlytechnology.com)

Requirements
------------
* SilverStripe 2.4

Documentation
-------------
[GitHub](https://github.com/frankmullenger/silverstripe-holdingpage)

Installation Instructions
-------------------------
1. Place this directory in the root of your SilverStripe installation, probably best to call the folder 'holdingpage'.
2. Visit yoursite.com/dev/build to rebuild the database.

Usage Overview
--------------
1. Create a new HoldingPage in the CMS area of your SilverStripe installation.
2. Choose a holding page to display in the config area of the CMS (the top item in the Page Tree).
3. Log in as an admin user if you want to bypass the holding page and navigate your website.

Important
---------
If you unpublish a holding page which is currently being used as the holding page for the site 
(you have that page selected in the config area) then after the page is unpublished it will no longer be set 
as the holding page for the site.

Known Issues
------------
[GitHub Issue Tracker](https://github.com/frankmullenger/silverstripe-holdingpage/issues)
