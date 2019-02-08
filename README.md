# Text File Viewer
This website App for ownCloud provides lightweight file browsing and text file display.

A text-only interface can be much faster than scrolling an infinite river of files or downloading a text file into a separate app just to see it.

Security may be improved if this helps you avoid saving files to a public or mobile device.

## Installation
1. The file path must be `/var/www/owncloud/apps/files_textviewer/` or equivalent.  The name of the leaf directory should not be changed.
1. Copy or checkout all of the files to the correct path.
1. Verify correct ownership and permissions for the files_textviewer directory.
1. Log in to ownCloud as an administrator.
1. In your user menu, click "Settings".
1. Click "Apps".
1. Click "Show disabled apps".
1. Find the Text File Viewer tile and click "Enable".

## Limitations
Each file is assumed to be either UTF-8 or Windows-1252 encoded.  This will not work with other types of text files.
