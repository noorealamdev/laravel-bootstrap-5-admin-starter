/*! Table Of Contents:
// ------------------------------
// INITIALIZE CODEMIRROR
// CODE LOADING
// DEFAULTS
// LOCAL STORAGE
// EDITOR UPDATES
// DEPENDENCY INJECTION
// RESIZE FUNCTIONS
// GENERAL FUNCTIONS
// UTILITY FUNCTIONS
// REFRESH EDITOR
// ------------------------------
*/


// make jQuery play nice
var E = $.noConflict(true);

E(document).ready(function () {

    // INITIALIZE CODEMIRROR
    // ------------------------------
    // html code
    var editorHTML = document.editor = CodeMirror.fromTextArea(htmlcode, {
        mode: 'htmlmixed',
        profile: 'html',
        keyMap: 'sublime',
        lineNumbers: true,
        lineWrapping: false,
        theme: 'dracula',
        tabSize: 4,
        indentUnit: 4,
        extraKeys: {
            'Tab': 'indentMore'
        },
        foldGutter: true,
        gutters: ['CodeMirror-lint-markers', 'CodeMirror-linenumbers', 'CodeMirror-foldgutter'],
        matchTags: {
            bothTags: true
        },
        matchBrackets: false,
        autoCloseTags: true,
        autoCloseBrackets: true,
        scrollbarStyle: 'overlay',
        styleActiveLine: true,
        showTrailingSpace: true,
        lint: false
    });

    // font size
    var fontSize = E('.font-size input');
    function updateFontSize(editor, size) {
        editor.getWrapperElement().style['font-size'] = size + '%';
        editor.refresh();
    }


    // CODE LOADING
    // ------------------------------
    // preview window
    var iframe = document.getElementById('preview'),
        preview;

    if (iframe.contentDocument) {
        preview = iframe.contentDocument;
    } else if (iframe.contentWindow) {
        preview = iframe.contentWindow.document;
    } else {
        preview = iframe.document;
    }

    // load html
    function loadHTML() {
        var body = E('#preview').contents().find('body'),
            html = editorHTML.getValue();

        body.html(html);
    }

    // start html
    function startHTML() {
        var html = editorHTML.getValue();
        var iframe = document.getElementById('preview').contentWindow.document;
        iframe.open();
        //getting value from editor and puts in the iframe
        iframe.write(html);
        iframe.close();
    }

    // run html
    startHTML();


    // DEFAULTS
    // ------------------------------
    var defaultFontSize = '100';
    var defaultHTML = "";
    // Get hidden values
    var itemId = E('.hidden-values .itemId').val();
    var itemHasHtml = E('.hidden-values .itemHtml').val();
    if (itemHasHtml) {
        localStorage.setItem('htmlcode', itemHasHtml);
        defaultHTML = itemHasHtml;
    } else {
        defaultHTML = '<!-- HTML code -->\n' +
            '<section id="cm-id-'+itemId+'">\n' +
            '    \n' +
            '</section>\n' +
            '\n' +
            '\n' +
            '<!-- JS code -->\n' +
            '<script>\n' +
            '    document.addEventListener("DOMContentLoaded", function () {\n' +
            '        console.log("DOM fully loaded and parsed");\n' +
            '    });\n' +
            '</script>\n' +
            '\n' +
            '\n' +
            '<!-- CSS code -->\n' +
            '<style>\n' +
            '    :root {\n' +
            '        --cm-id-'+itemId+'-color-primary: #2196F3;\n' +
            '        --cm-id-'+itemId+'-color-secondary: #64DD17;\n' +
            '    }\n' +
            '    #cm-id-'+itemId+' {\n' +
            '        position: relative;\n' +
            '    }\n' +
            '</style>';
    }

    var htmlBoilerplate = '<!-- HTML code -->\n' +
        '<section id="cm-id-'+itemId+'">\n' +
        '    \n' +
        '</section>\n' +
        '\n' +
        '\n' +
        '<!-- JS code -->\n' +
        '<script>\n' +
        '    document.addEventListener("DOMContentLoaded", function () {\n' +
        '        console.log("DOM fully loaded and parsed");\n' +
        '    });\n' +
        '</script>\n' +
        '\n' +
        '\n' +
        '<!-- CSS code -->\n' +
        '<style>\n' +
        '    :root {\n' +
        '        --cm-id-'+itemId+'-color-primary: #2196F3;\n' +
        '        --cm-id-'+itemId+'-color-secondary: #64DD17;\n' +
        '    }\n' +
        '    #cm-id-'+itemId+' {\n' +
        '        position: relative;\n' +
        '    }\n' +
        '</style>';


    // LOCAL STORAGE
    // ------------------------------
    // set default html value
    if (localStorage.getItem('htmlcode') === null || localStorage.getItem('htmlcode') === "") {
        localStorage.setItem('htmlcode', defaultHTML);
    }

    // set default font size
    if (localStorage.getItem('fontsize') === null || localStorage.getItem('fontsize') === "") {
        localStorage.setItem('fontsize', defaultFontSize);
    }

    // load code values
    editorHTML.setValue(localStorage.getItem('htmlcode'));

    // load font size
    fontSize.val(localStorage.getItem('fontsize'));


    // EDITOR UPDATES
    // ------------------------------
    // editor update (html)
    var delayHTML;
    editorHTML.on('change', function () {
        if (watch) {
            clearTimeout(delayHTML);
            delayHTML = setTimeout(loadHTML, 1000);
        }
        emmetCodeMirror(editorHTML);
        localStorage.setItem('htmlcode', editorHTML.getValue());
    });

    // run font size update
    updateFontSize(editorHTML, fontSize.val());

    // run editor update (html)
    loadHTML();


    // DEPENDENCY INJECTION
    // ------------------------------
    // cdnjs typeahead search
    var query = E('.cdnjs-search .query');
    E.get('https://api.cdnjs.com/libraries?fields=version,description').done(function (data) {
        var searchData = data.results,
            search = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: searchData
            });

        query.typeahead(null, {
            display: 'name',
            name: 'search',
            source: search,
            limit: Infinity,
            templates: {
                empty: function () {
                    return '<p class="no-match">unable to match query!</p>';
                },
                suggestion: function (data) {
                    return '<p class="lib"><span class="name">' + data.name + '</span> <span class="version">' + data.version + '</span><br><span class="description">' + data.description + '</span></p>';
                }
            }
        }).on('typeahead:select', function (e, datum) {
            var latest = datum.latest;
            loadDep(latest);
            clearSearch();
        }).on('typeahead:change', function () {
            clearSearch();
        });
    }).fail(function () {
        alert('error getting cdnjs libraries!');
    });

    // clear typeahead search and close results list
    function clearSearch() {
        query.typeahead('val', '');
        query.typeahead('close');
    }

    // load dependency
    function loadDep(url) {
        var dep;
        if (url.indexOf('<') !== -1) {
            dep = url;
        } else {
            if (url.endsWith('.js')) {
                dep = '<script src="' + url + '"><\/script>';
            } else if (url.endsWith('.css')) {
                dep = '@import url("' + url + '");';
            }
        }

        function insertDep(elem, line) {
            elem.replaceRange(dep + '\n', {
                line: line,
                ch: 0
            });
        }

        if (editorHTML.getValue().indexOf(dep) !== -1) {
            alert('dependency already included!');
        } else {
            var line;
            if (url.endsWith('.js')) {
                line = editorHTML.getValue().split('<\/script>').length - 1;
                insertDep(editorHTML, line);
                E('.code-swap-html').click();
            }

            alert('dependency added successfully!');
        }
    }


    // RESIZE FUNCTIONS
    // ------------------------------
    // drag handle to resize code pane
    var resizeHandle = E('.code-pane'),
        widthBox = E('.preview-width'),
        windowWidth = E(window).width();

    resizeHandle.resizable({
        handles: 'e',
        minWidth: 0,
        maxWidth: windowWidth - 16,
        create: function () {
            var currentWidth = resizeHandle.width(),
                previewWidth = windowWidth - currentWidth - 16;
            widthBox.text(previewWidth + 'px');
        },
        resize: function (e, ui) {
            var currentWidth = ui.size.width,
                previewWidth = windowWidth - currentWidth - 16;
            ui.element.next().css('width', windowWidth - currentWidth + 'px');
            ui.element.next().find('iframe').css('pointer-events', 'none');
            widthBox.show();
            if (currentWidth <= 0) {
                widthBox.text(windowWidth - 16 + 'px');
            } else {
                widthBox.text(previewWidth + 'px');
            }
        },
        stop: function (e, ui) {
            ui.element.next().find('iframe').css('pointer-events', 'inherit');
            widthBox.hide();
            editorHTML.refresh();
        }
    });


    // GENERAL FUNCTIONS
    // ------------------------------
    // code pane and wrap button swapping
    function swapOn(elem) {
        elem.css({
            'position': 'relative',
            'visibility': 'visible'
        });
    }

    function swapOff(elem) {
        elem.css({
            'position': 'absolute',
            'visibility': 'hidden'
        });
    }

    E('.code-swap span').not('.toggle-view').on('click', function () {
        var codeHTML = E('.code-pane-html'),
            wrapHTML = E('.toggle-lineWrapping.html'),
            preview = E('.preview-pane');

        E(this).addClass('active').siblings().removeClass('active');

        if (E(this).is(':contains("HTML")')) {
            swapOn(codeHTML);
            swapOn(wrapHTML);
            if (E(window).width() <= 800) {
                swapOff(preview);
            } else {
                swapOn(preview);
            }
        } else if (E(this).is(':contains("CSS")')) {
            swapOff(codeHTML);
            swapOff(wrapHTML);
            if (E(window).width() <= 800) {
                swapOff(preview);
            } else {
                swapOn(preview);
            }
        } else if (E(this).is(':contains("JS")')) {
            swapOff(codeHTML);
            swapOff(wrapHTML);
            if (E(window).width() <= 800) {
                swapOff(preview);
            } else {
                swapOn(preview);
            }
        } else if (E(this).is(':contains("preview")')) {
            swapOn(preview);
            swapOff(codeHTML);
            swapOff(wrapHTML);
        }
    });

    // expanding scrollbars
    var vScroll = E('.CodeMirror-overlayscroll-vertical'),
        hScroll = E('.CodeMirror-overlayscroll-horizontal');

    vScroll.on('mousedown', function () {
        E(this).addClass('hold');
    });

    hScroll.on('mousedown', function () {
        E(this).addClass('hold');
    });

    E(document).on('mouseup', function () {
        vScroll.removeClass('hold');
        hScroll.removeClass('hold');
    });

    // indent wrapped lines
    function indentWrappedLines(editor) {
        var charWidth = editor.defaultCharWidth(),
            basePadding = 4;
        editor.on('renderLine', function (cm, line, elt) {
            var off = CodeMirror.countColumn(line.text, null, cm.getOption('tabSize')) * charWidth;
            elt.style.textIndent = '-' + off + 'px';
            elt.style.paddingLeft = (basePadding + off) + 'px';
        });
    }

    // run indent wrapped lines
    indentWrappedLines(editorHTML);


    // UTILITY FUNCTIONS
    // ------------------------------

    // Preview mode desktop and mobile
    E('.preview-mode .default').on('click', function () {
        E('.code-pane').css({'width': 'calc(50% - 16px)'})
        E('.preview-pane').css({'width': 'calc(50% + 16px)'})
        editorHTML.refresh();
    })
    E('.preview-mode .desktop').on('click', function () {
        E('.code-pane').css({'width': 0})
        E('.preview-pane').css({'width': windowWidth + 'px'})
        editorHTML.refresh();
    })
    E('.preview-mode .mobile').on('click', function () {
        E('.code-pane').css({'width': '1135.25px'})
        E('.preview-pane').css({'width': '400.75px'})
        editorHTML.refresh();
    })

    // font size
    fontSize.on('change keyup', function () {
        var size = E(this).val();
        updateFontSize(editorHTML, size);
        localStorage.setItem('fontsize', size);
    });

    // toggle view
    E('.toggle-view').on('click', function () {
        E(this).toggleClass('enabled');
        if (E(this).hasClass('enabled')) {
            E(this).html('view');
        } else {
            E(this).html('view');
        }
    });

    // toggle tools
    E('.toggle-tools').on('click', function () {
        E(this).toggleClass('active');
        if (E(this).hasClass('active')) {
            E(this).html('Tools');
        } else {
            E(this).html('Tools');
        }
    });

    // toggle line wrapping (html)
    E('.toggle-lineWrapping.html').toggleClass('active');
    editorHTML.setOption('lineWrapping', true);
    E('.toggle-lineWrapping.html').on('click', function () {
        E(this).toggleClass('active');
        if (E(this).hasClass('active')) {
            editorHTML.setOption('lineWrapping', true);
            E(this).html('wrap');
        } else {
            editorHTML.setOption('lineWrapping', false);
            E(this).html('wrap');
        }
    });

    // emmet
    E('.toggle-emmet').toggleClass('active');

    E('.toggle-emmet').on('click', function () {
        E(this).toggleClass('active');
        if (E(this).hasClass('active')) {
            emmetCodeMirror(editorHTML);
            E(this).html('emmet');
        } else {
            emmetCodeMirror.dispose(editorHTML);
            E(this).html('emmet');
        }
    });

    // linting
    E('.toggle-lint').on('click', function () {
        E(this).toggleClass('active');
        if (E(this).hasClass('active')) {
            editorHTML.setOption('lint', true);
            E(this).html('lint');
        } else {
            editorHTML.setOption('lint', false);
            E(this).html('lint');
        }
    });

    // watch for changes
    var watch = true;
    E('.toggle-watch').on('click', function () {
        E(this).toggleClass('active');
        if (E(this).hasClass('active')) {
            watch = true;
            loadHTML();
            E(this).html('watch');
        } else {
            watch = false;
            E(this).html('watch');
        }
    });

    // html boilerplate code inject
    E('.boilerplate').on('click', function () {
        editorHTML.setValue('');
        editorHTML.setValue(htmlBoilerplate);
    });

    // reset editor
    E('.reset-editor').on('click', function () {
        editorHTML.setValue(defaultHTML);
    });

    // refresh editor
    E('.refresh-editor').on('click', function () {
        location.reload();
    });

    // clear editor
    E('.clear-editor').on('click', function () {
        editorHTML.setValue('');
    });

    // run script
    E('.run-script').on('click', function () {
        loadHTML();

        if (E(window).width() <= 800) {
            E('.toggle-preview').click();
        }
    });

    // save as html file
    E('.saveHtml').on('click', function () {
        var text = '<!DOCTYPE html>\n<html lang="en">\n<head>\n<meta charset="utf-8">\n<meta name="viewport" content="width=device-width, initial-scale=1">\n<link rel="stylesheet" href="https://rawgit.com/markhillard/Editor/gh-pages/css/reset.css"></head>\n<body>\n' + editorHTML.getValue() + '\n</body>\n</html>\n',
            blob = new Blob([text], {
                type: 'text/html; charset=utf-8'
            });

        saveAs(blob, 'editor.html');
    });


    // REFRESH EDITOR
    // ------------------------------
    editorHTML.refresh();

});
