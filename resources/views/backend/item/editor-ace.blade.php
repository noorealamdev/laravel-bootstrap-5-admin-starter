@php
    $generated_item_id = 'cm-id-' . $item_id;
@endphp
<!DOCTYPE html>

<html>
<head>
    <title>CodeMela HTML Editor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.6/ace.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
            overflow-x: hidden;
        }

        /* Hides the scrollbar while still able to scroll */
        ::-webkit-scrollbar {
            width: 0; /* Remove scrollbar space */
            background: transparent; /* Optional: just make scrollbar invisible */
        }

        #container {
            height: 100%;
            width: auto;
            white-space: nowrap;
            overflow: hidden;
        }

        #iframe {
            border: 1px solid black;
            background: rgb(247, 254, 255);
            height: 50%;
            /* display:inline-block;  */
            width: 100%;
            /* what is inline */
        }

        #editors {
            border: 2px solid black;
            position: relative;
            background-color: #21222C;
            height: 100vh;
            width: 100%;
            /* what is inline */
            /* display:inline-block;  */
        }

        .editor {
            border: 1.5px solid black;
            position: absolute;
            top: 8%;
            height: 90%;
            width: 100%;
        }

        #htmlEditor {

        }

        .header-wrapper {
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 55px;
        }
        .header-wrapper .header-html-icon {
            display: flex;
            align-items: center;
        }

        .header-wrapper .header-html-icon span {
            color: #c5c5c5;
        }
        .header-wrapper .header-text {
            color: #c5c5c5;
            font-size: large;
        }
        .header-wrapper .header-btn {
            display: flex;
            gap: 15px;
        }

        .btn {
            -webkit-transition: all .2s;
            transition: all .2s;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            padding: 5px 20px;
            cursor: pointer;
        }

        .btn.btn-outline {
            background: 0 0
        }

        .btn-outline.btn-primary {
            border-color: #2196F3;
            color: #2196F3
        }

        .btn-outline.btn-success {
            border-color: #64DD17;
            color: #64DD17
        }

        .btn-outline.btn-warning {
            border-color: #FFD600;
            color: #FFD600
        }

        .btn-outline.btn-danger {
            border-color: #ef1c1c;
            color: #ef1c1c
        }
    </style>

</head>

<body onload='ready()'>
<div id='container'>
    <div id='editors'>
        <div class="header-wrapper">
            <div class="header-html-icon">
                <svg height="40px" width="40" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#2196F3;" d="M374.672,512H91.744c-15.976-0.048-28.92-12.992-28.968-28.968V28.968 C62.824,12.992,75.768,0.048,91.744,0h328.512c15.976,0.048,28.92,12.992,28.968,28.968v408.696"></path> <g> <path style="fill:#FFD07D;" d="M374.656,452.528V512l74.568-74.336h-59.696C381.328,437.688,374.68,444.328,374.656,452.528z"></path> <path style="fill:#FFD07D;" d="M130.576,159.352l85.6-39.752v18.896l-64.712,28.344v0.36l64.712,28.344V214.4l-85.6-39.752 L130.576,159.352z"></path> <path style="fill:#FFD07D;" d="M229.352,221.6l38.152-129.28h18.008L247.36,221.6H229.352z"></path> <path style="fill:#FFD07D;" d="M381.424,175.2l-85.6,39.2v-18.864L362,167.2v-0.36l-66.136-28.344V119.6l85.6,39.2L381.424,175.2z"></path> </g> <g> <path style="fill:#FFFFFF;" d="M136.056,359.2H117.36l20-95.528h18.704l-7.2,34.016c3.576-2.92,7.552-5.32,11.8-7.136 c3.736-1.472,7.72-2.216,11.736-2.184c4.896-0.272,9.696,1.464,13.288,4.8c3.312,3.352,5.088,7.928,4.888,12.64 c-0.192,4.352-0.784,8.672-1.776,12.912l-8.488,40.48H161.6l8.664-41.248c0.672-2.832,1.128-5.704,1.368-8.6 c0.096-2.064-0.688-4.08-2.152-5.536c-1.6-1.456-3.712-2.208-5.864-2.088c-3.28,0.056-6.44,1.2-8.992,3.256 c-3.656,2.776-6.584,6.392-8.528,10.552c-1.912,5.272-3.352,10.696-4.304,16.224L136.056,359.2z"></path> <path style="fill:#FFFFFF;" d="M203.32,303.864l2.864-13.872h9.12l2.28-11.08l21.44-12.904l-5.016,24h11.408l-2.864,13.872h-11.48 l-6.064,29c-0.688,2.968-1.216,5.968-1.6,8.992c-0.072,1.272,0.432,2.504,1.368,3.36c1.464,0.952,3.216,1.376,4.952,1.2 c0.824,0,2.88-0.152,6.184-0.456l-2.928,13.872c-3.256,0.664-6.576,0.992-9.904,0.984c-5.096,0.432-10.184-0.92-14.4-3.816 c-3.064-2.656-4.728-6.568-4.52-10.616c0.432-4.96,1.232-9.888,2.4-14.728l5.8-27.832L203.32,303.864z"></path> <path style="fill:#FFFFFF;" d="M256.952,289.984h17.6L272.8,298.4c5.568-6.104,13.344-9.72,21.6-10.048 c4.264-0.272,8.504,0.872,12.056,3.256c2.856,2.224,4.784,5.432,5.408,8.992c2.664-3.712,6.2-6.704,10.296-8.728 c4.288-2.304,9.08-3.512,13.944-3.52c4.72-0.28,9.352,1.312,12.904,4.432c3.128,3.08,4.808,7.344,4.624,11.736 c-0.248,4.176-0.864,8.32-1.832,12.384l-8.832,42.296h-18.704l8.856-42.288c1.064-5.304,1.6-8.304,1.6-8.992 c0.088-1.688-0.544-3.328-1.728-4.528c-1.44-1.208-3.296-1.808-5.176-1.664c-5.112,0.256-9.768,3.008-12.448,7.368 c-3.496,5.712-5.808,12.072-6.784,18.704l-6.536,31.4h-18.704l8.728-41.832c0.752-3.08,1.264-6.208,1.528-9.368 c0.056-1.696-0.616-3.328-1.848-4.496c-1.408-1.232-3.248-1.864-5.12-1.76c-2.232,0.056-4.408,0.688-6.32,1.832 c-2.224,1.264-4.168,2.968-5.704,5.016c-1.824,2.496-3.248,5.272-4.208,8.208c-0.536,1.56-1.376,5.104-2.536,10.624l-6.68,31.776 H242.48L256.952,289.984z"></path> <path style="fill:#FFFFFF;" d="M361.6,359.2l20-95.528h18.64L380.304,359.2H361.6z"></path> </g> </g></svg>

                <span>HTML code only</span>
            </div>
            <div class="header-text">
                Section ID: <strong>{{ $generated_item_id }}</strong>
            </div>
            <div class="header-btn">
                <button type="button" class="btn btn-primary btn-outline" onclick="minimizeIframe()">Code</button>
                <button type="button" class="btn btn-success btn-outline" onclick="maximizeIFrame()">Preview</button>
                <button type="button" class="btn btn-warning btn-outline" data-bs-toggle="modal" data-bs-target="#sampleCodeModal">Sample Code</button>
                <form style="margin-left: 40px" action="{{ route('item.saveCode') }}" method="post">
                    @csrf
                    <input type="hidden" value="{{ $item_id }}">
                    <input type="hidden" name="code">
                    <button type="button" class="btn btn-danger btn-outline">Save Code</button>
                </form>
            </div>
        </div>

        <div class='editor' id='htmlEditor'></div>
    </div>

    <iframe id='iframe' frameborder="0"></iframe>


    <!-- Sample Code Modal -->
    <div class="modal fade" id="sampleCodeModal" aria-hidden="true">
        <div class="modal-dialog mw-100 w-75">
            <div class="modal-content">
                <div class="modal-body">
                    <pre>
<code class="language-html">&lt;!-- HTML code --&gt;
&lt;section id="{{ $generated_item_id }}"&gt;

&lt;/section&gt;

&lt;!-- JS code --&gt;
&lt;script&gt;
    document.addEventListener("DOMContentLoaded", function () {
        console.log("DOM fully loaded and parsed");
    });
&lt;/script&gt;

&lt;!-- CSS code --&gt;
&lt;style&gt;
    :root {
        --{{ $generated_item_id }}-color-primary: #2196F3;
        --{{ $generated_item_id }}-color-secondary: #64DD17;
    }
    #{{ $generated_item_id }} {
        position: relative;
    }
&lt;/style&gt;</code>
                    </pre>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    hljs.highlightAll();
</script>

<script>

    var codeInput = $('input[name="code"]');

    //Download Code File
    function downloadCode() {
        //1.Create a blob
        const userCode = getUserCode();
        console.log(userCode)
    }


    function getUserCode() {
        return htmlEditor.getValue();
    }

    downloadCode();

    function update() {
        //this is the content of iframe
        var code = document.getElementById('iframe').contentWindow.document;
        code.open();
        //getting value from editor and puts in the iframe
        code.write(getUserCode());
        code.close();

        codeInput.val(editor.getValue());
    }

    function loadHTMLEditor() {
        //defaultHTMLValue = "<!DOCTYPE html>\n\n<html>\n\n    <!-- Your HTML code goes right here -->\n\n</html>"
        defaultHTMLValue = `<\!-- HTML code -->
<section id="{{ $generated_item_id }}">

</section>

<\!-- JS code -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        console.log("DOM fully loaded and parsed");
    });
<\/script>

<\!-- CSS code -->
<style>
    :root {
        --{{ $generated_item_id }}-color-primary: #2196F3;
        --{{ $generated_item_id }}-color-secondary: #64DD17;
    }
    #{{ $generated_item_id }} {
        position: relative;
    }
</style>`

        //tells ace editor to use editor element , window.editor makes it global in the javascript file
        var htmlEditor = ace.edit("htmlEditor");
        //mode mode
        htmlEditor.setTheme("ace/theme/dracula");
        //html mode
        htmlEditor.getSession().setMode("ace/mode/html");
        //sample text
        htmlEditor.setValue(defaultHTMLValue, 1); //1 = moves cursor to end
        // when something changed in editor update is called
        htmlEditor.getSession().on('change', function () {
            update();
        });
        // puts cursor in the editor
        htmlEditor.focus();

        //htmlEditor.setOption('showLineNumbers', true);
        htmlEditor.setOptions({
            fontSize: "12.5pt",
            showLineNumbers: true,
            vScrollBarAlwaysVisible: false,
            enableBasicAutocompletion: true,
            enableSnippets: true,
            enableLiveAutocompletion: false
        });

        htmlEditor.setShowPrintMargin(false);
        //htmlEditor.setBehavioursEnabled(false);
    }

    function setupEditor() {
        loadHTMLEditor();
    }

    function ready() {
        setupEditor();
    }

    function maximizeIFrame() {
        //First make Iframe height larger
        let iframe = document.getElementById("iframe");
        iframe.style.height = "98%";
        iframe.style.width = "100%";
        //Next equate all 3 editors dimensions to 0
        let htmlEditor = document.getElementById("htmlEditor");
        htmlEditor.style.height = "0%";
        htmlEditor.style.width = "0%";
        //Make editors height 8% which has labels and buttons
        let allEditors = document.getElementById("editors");
        allEditors.style.height = "8%";
        allEditors.style.width = "100%";
    }

    function minimizeIframe() {
        //Going in reverse order from maximizeFrame() to reset all elements to their original dimensions
        let editors = document.getElementById("editors");
        editors.style.height = "100%";
        editors.style.width = "100%";
        let htmlEditor = document.getElementById("htmlEditor");
        htmlEditor.style.height = "90%";
        htmlEditor.style.width = "100%";
        var iframe = document.getElementById("iframe");
        iframe.style.height = "50%";
        iframe.style.width = "100%";
    }

</script>

</body>

</html>
