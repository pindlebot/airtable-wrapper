# airtable-wrapper
A PHP wrapper for Airtable. Use Airtable as a database for your website. This example demonstrates both reading and writing from an Airtable base. In other words, data is not only fetched from Airtable but changes you make on the website are reflected in your Airtable in real time. 

You can see a live demo [here](http://scheduletext.com/airtable/). 

## Setup
Sign up for an Airtable account and note your API key, spreadsheet ID, and table name. Add these to <code>settings.php</code>.

For this project you'll need PHP and curl (PHP requires libcurl version 7.10.5 or later).

You can find more Airtable API [tutorials and examples here](http://www.automationfuel.com/airtable-api-example-tutorial/). 

## Notes
This repo contains some unnecessary files. For example, I'm using the css framework Materialize to style the project which is not required for it to work.

The essential files are:
```
|__index.php
|__settings.php
|__post.php
|__js
   |__scripts.js
```
  
I'm using Gulp to minify css and js but these tools are optional. If you don't want to use Gulp you can safely delete <code>package.json</code> and <code>gulpfile.js</code>.