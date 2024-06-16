@php
    $generated_item_id = 'cm-id-' . $item->id;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<title>CodeMela HTML Editor</title>

<!--general meta information-->
<meta charset="utf-8">
<meta name="description" content="Editor is a responsive HTML/CSS/JS code editor that renders what you type in real-time.">
<meta name="keywords" content="html, css, javascript, jquery, code, editor, real-time, responsive">

<!--mobile specific meta information-->
<meta name="viewport" content="width=device-width, initial-scale=1">


<!--favicons-->
<link rel="apple-touch-icon" sizes="180x180" href="./favicons/apple-touch-icon.png?v=4">
<link rel="icon" type="image/png" sizes="32x32" href="./favicons/favicon-32x32.png?v=4">
<link rel="icon" type="image/png" sizes="16x16" href="./favicons/favicon-16x16.png?v=4">
<link rel="manifest" href="./favicons/site.webmanifest?v=4">
<link rel="mask-icon" href="./favicons/safari-pinned-tab.svg?v=4" color="#282a36">
<link rel="shortcut icon" href="./favicons/favicon.ico?v=4">
<meta name="msapplication-TileColor" content="#282a36">
<meta name="msapplication-config" content="./favicons/browserconfig.xml?v=4">
<meta name="theme-color" content="#282a36">

<!--cdn preconnect-->
<link rel="preconnect" href="https://cdn.jsdelivr.net">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!--font styles-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/firacode@latest/distr/fira_code.css" data-noprefix>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@400;700&display=swap" data-noprefix>

<!--jquery ui styles-->
<link rel="stylesheet" href="{{ asset('backend/editor/css/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/editor/css/jquery-ui.structure.min.css') }}">

<!--codemirror styles-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@latest/lib/codemirror.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/fold/foldgutter.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/scroll/simplescrollbars.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/lint/lint.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@latest/theme/dracula.css">

<!--requried styles-->
<link rel="stylesheet" href="{{ asset('backend/editor/css/styles.css') }}">

<!--loading indicator-->
<script>
    document.onreadystatechange = function () {
        var state = document.readyState;
        if (state === 'interactive') {
            document.getElementById('wrapper').style.visibility = 'hidden';
        } else if (state === 'complete') {
            setTimeout(function () {
                document.getElementById('wrapper').style.visibility = 'visible';
                document.getElementById('load').style.opacity = '0';
                document.querySelector('.lds-ellipsis').style.visibility = 'hidden';
            }, 500);

            setTimeout(function () {
                document.getElementById('load').style.visibility = 'hidden';
            }, 1000);
        }
    }
</script>

<!--required scripts-->
<script src="https://cdn.jsdelivr.net/npm/jquery@latest/dist/jquery.min.js"></script>
<script src="{{ asset('backend/editor/js/jquery-ui.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/prefixfree@latest/prefixfree.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/htmlhint@latest/lib/htmlhint.js"></script>
<script src="https://cdn.jsdelivr.net/npm/csslint@latest/dist/csslint.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jshint@latest/dist/jshint.js"></script>

<!--codemirror main-->
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/lib/codemirror.min.js"></script>

<!--codemirror modes-->
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/mode/xml/xml.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/mode/htmlmixed/htmlmixed.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/mode/css/css.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/mode/javascript/javascript.min.js"></script>

<!--codemirror addons-->
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/fold/xml-fold.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/fold/foldcode.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/fold/foldgutter.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/fold/brace-fold.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/edit/matchtags.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/edit/matchbrackets.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/edit/closetag.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/edit/closebrackets.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/edit/trailingspace.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/scroll/simplescrollbars.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/selection/active-line.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/comment/comment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/lint/lint.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/lint/html-lint.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/lint/css-lint.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/addon/lint/javascript-lint.min.js"></script>

<!--codemirror keymap-->
<script src="https://cdn.jsdelivr.net/npm/codemirror@latest/keymap/sublime.min.js"></script>

<!--twitter typeahead-->
<script src="https://cdn.jsdelivr.net/npm/typeahead.js@latest/dist/typeahead.bundle.min.js"></script>

<!--emmet-->
<script async src="https://cdn.jsdelivr.net/npm/emmet-codemirror@latest/dist/emmet.min.js"></script>

<!--file saver-->
<script defer src="https://cdn.jsdelivr.net/npm/blob.js@latest/Blob.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/file-saver@latest/dist/FileSaver.min.js"></script>

<!--font awesome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>


<body>
<!--loading indicator-->
<div id="load">
    <div class="lds-ellipsis"><p>loading</p><div></div><div></div><div></div><div></div></div>
</div>
<!--begin wrapper-->
<main id="wrapper">
    <section id="utils">
        <div class="logo">
            <a href="javascript:void(0)" title="Editor on GitHub">HTML Editor</a>
        </div>
        <div class="code-swap">
            <span class="toggle-view">view<span class="fa-solid fa-fw fa-chevron-down"></span></span>
            <span class="code-swap-html active" href="#">HTML</span>
        </div>
        <div class="font-size">
            <label class="fa-layers fa-fw" for="fs">
                <span class="fa-solid fa-font"></span>
                <span class="fa-solid fa-percent" data-fa-transform="shrink-7 up-2 right-12"></span>
            </label>
            <input id="fs" type="number" min="50" max="200" value="100">
        </div>
        <div class="preview-mode">
            <i class="default fa-solid fa-table-columns"></i>
            <i class="desktop fa-solid fa-desktop"></i>
            <i class="mobile fa-solid fa-mobile-screen-button"></i>
        </div>
        <div class="html-section-id"><h3>Section ID: <strong>{{ $generated_item_id }}</strong></h3></div>
        <div class="code-tools">
            <span class="toggle-tools">Tools</span>
            <span class="toggle-lineWrapping html">wrap</span>
            {{--<span class="toggle-emmet">emmet</span>--}}
            <span class="toggle-lint">lint</span>
            <span class="toggle-watch active">watch</span>
            <span class="boilerplate">boilerplate</span>
            <span class="reset-editor">reset</span>
            <span class="refresh-editor">refresh</span>
            <span class="clear-editor">clear</span>
            {{--<span class="run-script">run</span>--}}
            <span class="save" data-itemId="{{ $item->id }}">save & go</span>
        </div>
        <div class="cdnjs-search">
            <input class="query" type="text" placeholder="cdnjs...">
        </div>
    </section>
    <section id="editor">
        <div class="code-pane">
            <div class="code-pane-html">
                <textarea id="htmlcode" name="htmlcode"></textarea>
            </div>
        </div>
        <div class="preview-pane">
            <iframe id="preview"></iframe>
            <span class="preview-width"></span>
        </div>

        <div class="hidden-values">
            <input type="hidden" class="itemId" value="{{ $item->id }}">
            <input type="hidden" class="itemHtml" value="{{ $item->html }}">
        </div>
    </section>
</main>
<!--end wrapper-->

<!-- main -->
<script src="{{ asset('backend/editor/js/main.js') }}"></script>

<script>
    //var E = $.noConflict();
    E(document).ready(function(){
        // Empty local storage after launching the editor
        localStorage.setItem('htmlcode', '');
        E('.code-tools .save').on('click', function (e) {
            e.preventDefault();
            const htmlCode = localStorage.getItem('htmlcode');
            if (htmlCode !== "") {
                //console.log(htmlCode)
                let route = "{{ route('item.saveCode') }}";
                let token = "{{ csrf_token()}}";
                let itemId = E(this).attr("data-itemId");
                E.ajax({
                    url: route,
                    type: 'POST',
                    data: {
                        _token:token,
                        itemId: parseInt(itemId),
                        htmlCode: htmlCode,
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.success === true) {
                            localStorage.setItem('htmlcode', '');
                            window.location.href = "{{ route('item.edit', $item->id)}}";
                        }
                    },
                    error: function(error) {
                        //Do Something to handle error
                        console.log('saving code error:', error)
                    }
                });
            } else {
                alert('Please write some code...')
            }
        })
    });
</script>
</body>
</html>
