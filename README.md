# phpDocumentor markdown-public template

[phpDocumentor template](http://www.phpdoc.org/docs/latest/getting-started/changing-the-look-and-feel.html) that generates Markdown documentation of only the public API. It will skip all abstract classes and non-public methods.

The main use-case for this template is to generate simple and nice looking usage documentation, that can then be published on GitHub.

For example, a small library can document it's public API in DocBlock comments, use this template to generate the Markdown documentation and then commit it to GitHub with the library to easily create a nice looking documentation for other developers to see.

Example of documentation generated with this template: https://github.com/cvuorinen/raspicam-php/tree/master/docs

## Installation

Install with composer:

```bash
composer require cvuorinen/phpdoc-markdown-public
```

## Usage

Run phpDocumentor and set template as `vendor/cvuorinen/phpdoc-markdown-public/data/templates/markdown-public`.

**Example using command-line arguments:**

```bash
./vendor/bin/phpdoc --directory=src/ --target=docs/ --template="vendor/cvuorinen/phpdoc-markdown-public/data/templates/markdown-public" --title="My Project Documentation"
```

More information about the available arguments can be found at [running phpDocumentor](http://www.phpdoc.org/docs/latest/guides/running-phpdocumentor.html).

**Example using configuration file:**

Add a file called `phpdoc.xml` with the following content to the root of your project and invoke the `phpdoc` command without arguments. Modify the configuration to suit your project.

```xml
<?xml version="1.0" encoding="UTF-8" ?>
<phpdoc>
    <title>My Project Documentation</title>
    <parser>
        <target>build</target>
    </parser>
    <transformer>
        <target>docs</target>
    </transformer>
    <transformations>
        <template name="vendor/cvuorinen/phpdoc-markdown-public/data/templates/markdown-public" />
    </transformations>
    <files>
        <directory>src</directory>
        <ignore>test/*</ignore>
    </files>
</phpdoc>
```

More information about [configuring phpDocumentor](http://www.phpdoc.org/docs/latest/references/configuration.html).
