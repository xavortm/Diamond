![alt text](http://imageshack.com/a/img850/17/e3fp.png "Logo Title Text 1") Diamond - WordPress theme for developers.
===
---
This is the complete basic version of the Diamond startup themes. This one has __zero stylings on its elements__ except for css reset. There are only the templating files and their main structure. ALl other functionality is removed from the templating files, but its ready to call from Deiamond classes. Same thing goes for the functions.php file.

__The templates__ - Only the most basic structure is there. Create your own markup if you want or use what is there, there are no limitations.

---
### functions.php
Here things are a little more diferent. The structure is OOP like. (class and methods), but its not real OOP programing at all, just easier way to not worry about naming your functions. There is no need to write `if_function_exists()` or write something like `themename_start()`. 

Accesing public static methods is just by calling the class followed by the method: `ClassName::method();`, so there is no need of objects.

---
About the methods in the _functions.php_ file:

`theme_setup_core()` for the basic theme setup. The code is commented, i believe there are no missunderstandings here.

`add_actions()` is used to add all hooks for the theme. Easy way to find them and disable.

`load_scripts_and_styles()` is for initializing scripts and stylesheets.

`widgets_init()` for your widgets and sidebars. In the file you will see example how to insert widgets easily. 

`load_fonts()` as the name says, loading web fonts.

---

To be continued...