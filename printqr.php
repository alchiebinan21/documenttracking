<script>
function makepage(src)
{
return "<html>\n" +
"<head>\n" +
"<title>Temporary Printing Window</title>\n" +
"<script>\n" +
"function step1() {\n" +
" setTimeout('step2()', 10);\n" +
"}\n" +
"function step2() {\n" +
" window.print();\n" +
" window.close();\n" +
"}\n" +
"</scr" + "ipt>\n" +
"</head>\n" +
"<body onLoad='step1()'>\n" +
"<img src='" + src + "'/>\n" +
"</body>\n" +
"</html>\n";
}
function printme(evt)
{
if (!evt) {
// Old IE
evt = window.event;
} 
var image = evt.target;
if (!image) {
// Old IE
image = window.event.srcElement;
}
src = image.src;
link = "about:blank";
var pw = window.open(link, "_new");
pw.document.open();
pw.document.write(makepage(src));
pw.document.close();
}
</script>

