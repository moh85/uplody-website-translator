# Uplody Translator
One-file website translator tool using a flat database and powerfull GUI + REST API.


# About
I develop this project to translate my websites and projects easily without complex tools or libraries. Now, I want to share this project with you so you can create multilingual websites and scripts (mainly for PHP based websites).
The tool is very rich, it has many features:

1- A complete GUI to create/read/edit/delete (CRUD) texts.

2- A complete API so you can create your own GUI for example an internal multi-language support panel for your websites.

3- Flat database, no need for extra resources, data are saved in a (.php) file as an array.

4- Easy to use commands to get data using a simple PHP Class.

5- The ability to use the script to export data as JSON files so you can use the script as a translation panel.


# Setup (before using the script)
Edit the script file in any editor to change some settings:

```php
/* supported languages: lang_code => [name, direction, text_direction] */
define('______UPLODY______LANGS______', 
[
'en' => ['English', 'ltr', 'left'],
'ar' => ['العربية', 'rtl', 'right'],
]);

/* login password */
define('______UPLODY______PASSWORD______', 'password4862458621456247856245');

/* script name: change it according to your needs */
define('______UPLODY______SCRIPT______', 'uplody_translator.php');

/* database file name without (.php): change it according to your needs */
define('______DATABASE______FILE______', '_uplody_lang____');

/* how many flags to show per line in GUI page (based on Bootstrap Grid System). Recommended: 1 / 2 / 3 / 4 */
define('______UPLODY______LIMIT______', 4);

/* script version - no need to change */
define('______VERSION______', '1.0');
```


# A Simple GUI
The GUI allow you to add / edit / delete and translate texts easily without coding, also it has a Help Page and short API Docs.

To access the GUI, just visit the script path for example: **https://uplody.com/uplody_translator.php**

Then enter your password (the one you choosed on setup).

![Uplody Translator GUI](https://i.imgur.com/y4WFkr8.png)


# The Data Structure
Uplody translator save the data in a flat database - inside an array in a PHP file.

**Note: The database file is created in the same directory as the script.**

![Uplody Translator Array Format](https://i.imgur.com/IQTOU3J.png)


# How to Use (in webpages)
```php 
// add this code to your top page
$___ACTIVATE___TRANSLATOR___ = true; 
include_once('uplody_translator.php');

// create new "uplody_translator" object
$translator = new uplody_translator;

// ******************** usage #1

// to get all languages data
$data = $translator->get();

// to get flag value e.g. English ~ return an ARRAY e.g. ['en' => 'word', 'fr' => 'mot']
$word = $data['my_flag']['en'];

// ******************** usage #2

// to get a specific language data by language code (based on your script settings)
$data = $translator->get('en');

// to get flag value of selected language code ~ return a STRING e.g. "word"
$word = $data['my_flag'];

// ******************** usage #3

// to get data in JSON format just add "json" value when you create the object
$translator = new uplody_translator('json');
// show json data
$translator->get();
.
.
.
```


# The API
If you want to create your own GUI based on Uplody Translator you can use the following requests.

### Add / update text - single language
```
GET / POST
~ uplody_translator.php?password=[PASSWORD]&api_language=[LANGUAGE_CODE]&flag[]=my_flag_1&word[]=my_word_1

Example (single word to English):

~ uplody_translator.php?password=123456789&api_language=en&flag[]=website_name&word[]=uplody

Example (multiple words to English):

~ uplody_translator.php?password=123456789&api_language=en&flag[]=website_name&word[]=uplody&flag[]=slogan&word[]=great code ... great mind
```

### Add / update text - multiple languages
####Note: You must send multiple requests but in order: you must wait each request response to send the next one to avoid conflict.
```
Example:

- Request #1: GET / POST
~ uplody_translator.php?password=123456789&api_language=en&flag[]=website_name&word[]=uplody&flag[]=slogan&word[]=great code ... great mind

- Request #2: GET / POST
~ uplody_translator.php?password=123456789&api_language=ar&flag[]=website_name&word[]=أبلودي&flag[]=slogan&word[]=كود رائع ... ذهن رائع
```

### Delete one / multiple records by flag (in all languages)
```
GET / POST
~ uplody_translator.php?password=123456789&api_language=en&flag[]=website_name&delete=true
```
# Use Uplody translator as Translation Panel
You can use uplody translator as a way to export translation JSON files:

![Uplody Translator JSON Support](https://i.imgur.com/O8EGjkh.png)

The Used Code:
```php
.
.
.

// to get data in JSON format just add "json" value when you create the object
$translator = new uplody_translator('json');
// show json data
$translator->get();
```


# Finally ...
Feel free to ask me anything about this project and I hope it can help you :)
### Support Me
* You can support my work as an open source developer one patreon: https://patreon.com/uplody
* To see my other projects and tools: https://uplody.com/tools/
