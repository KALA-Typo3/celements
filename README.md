# celements
TYPO3 Extension with easy content element intergration

Old extension used to help to create custom content elements. This extension wasn't maintained for a longer period of time, because I use a cleaner way to add custom content elements to TYPO3 backend. I didn't testthis with TYPO3 V11 and V12

## How this extension work

You need 2 function calls to successfully add a custom content element to TYPO3 backend. One in /Configuration/TCA/Overrides/tt_content.php and in /ext_localconf.php. See a simple example in these files. Take note that in new TYPO3 versions you would additionally need to register your own icons via Icon API.  
