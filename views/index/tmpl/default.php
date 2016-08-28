<?php
defined( '_JEXEC' ) or die;

jimport('joomla.html.html.bootstrap');
require_once JPATH_ADMINISTRATOR . '/components/com_myjbzoostat/elements/paramsetc.php';


if ($csshack == 'yes') {
echo "<style>div#system-message-container {display:none;}</style>";
}



    if (!empty($counter_id)) :


$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/metrika.css');

$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/metrika.js');


$eyed = 'data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8cGF0aCBkPSJNMjU2LDk2QzE0NC4zNDEsOTYsNDcuNTU5LDE2MS4wMjEsMCwyNTZjNDcuNTU5LDk0Ljk3OSwxNDQuMzQxLDE2MCwyNTYsMTYwYzExMS42NTYsMCwyMDguNDM5LTY1LjAyMSwyNTYtMTYwICAgQzQ2NC40NDEsMTYxLjAyMSwzNjcuNjU2LDk2LDI1Niw5NnogTTM4Mi4yMjUsMTgwLjg1MmMzMC4wODIsMTkuMTg3LDU1LjU3Miw0NC44ODcsNzQuNzE5LDc1LjE0OCAgIGMtMTkuMTQ2LDMwLjI2MS00NC42MzksNTUuOTYxLTc0LjcxOSw3NS4xNDhDMzQ0LjQyOCwzNTUuMjU3LDMwMC43NzksMzY4LDI1NiwzNjhjLTQ0Ljc4LDAtODguNDI4LTEyLjc0My0xMjYuMjI1LTM2Ljg1MiAgIGMtMzAuMDgtMTkuMTg4LTU1LjU3LTQ0Ljg4OC03NC43MTctNzUuMTQ4YzE5LjE0Ni0zMC4yNjIsNDQuNjM3LTU1Ljk2Miw3NC43MTctNzUuMTQ4YzEuOTU5LTEuMjUsMy45MzgtMi40NjEsNS45MjktMy42NSAgIEMxMzAuNzI1LDE5MC44NjYsMTI4LDIwNS42MTMsMTI4LDIyMWMwLDcwLjY5MSw1Ny4zMDgsMTI4LDEyOCwxMjhjNzAuNjkxLDAsMTI4LTU3LjMwOSwxMjgtMTI4ICAgYzAtMTUuMzg3LTIuNzI1LTMwLjEzNC03LjcwMy00My43OTlDMzc4LjI4NSwxNzguMzksMzgwLjI2NiwxNzkuNjAyLDM4Mi4yMjUsMTgwLjg1MnogTTI1NiwyMDVjMCwyNi41MS0yMS40OSw0OC00OCw0OCAgIHMtNDgtMjEuNDktNDgtNDhzMjEuNDktNDgsNDgtNDhTMjU2LDE3OC40OSwyNTYsMjA1eiIgZmlsbD0iIzAwMDAwMCIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=';



$usersd = 'data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCIgdmlld0JveD0iMCAwIDgwLjEzIDgwLjEzIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA4MC4xMyA4MC4xMzsiIHhtbDpzcGFjZT0icHJlc2VydmUiPgo8Zz4KCTxwYXRoIGQ9Ik00OC4zNTUsMTcuOTIyYzMuNzA1LDIuMzIzLDYuMzAzLDYuMjU0LDYuNzc2LDEwLjgxN2MxLjUxMSwwLjcwNiwzLjE4OCwxLjExMiw0Ljk2NiwxLjExMiAgIGM2LjQ5MSwwLDExLjc1Mi01LjI2MSwxMS43NTItMTEuNzUxYzAtNi40OTEtNS4yNjEtMTEuNzUyLTExLjc1Mi0xMS43NTJDNTMuNjY4LDYuMzUsNDguNDUzLDExLjUxNyw0OC4zNTUsMTcuOTIyeiBNNDAuNjU2LDQxLjk4NCAgIGM2LjQ5MSwwLDExLjc1Mi01LjI2MiwxMS43NTItMTEuNzUycy01LjI2Mi0xMS43NTEtMTEuNzUyLTExLjc1MWMtNi40OSwwLTExLjc1NCw1LjI2Mi0xMS43NTQsMTEuNzUyUzM0LjE2Niw0MS45ODQsNDAuNjU2LDQxLjk4NCAgIHogTTQ1LjY0MSw0Mi43ODVoLTkuOTcyYy04LjI5NywwLTE1LjA0Nyw2Ljc1MS0xNS4wNDcsMTUuMDQ4djEyLjE5NWwwLjAzMSwwLjE5MWwwLjg0LDAuMjYzICAgYzcuOTE4LDIuNDc0LDE0Ljc5NywzLjI5OSwyMC40NTksMy4yOTljMTEuMDU5LDAsMTcuNDY5LTMuMTUzLDE3Ljg2NC0zLjM1NGwwLjc4NS0wLjM5N2gwLjA4NFY1Ny44MzMgICBDNjAuNjg4LDQ5LjUzNiw1My45MzgsNDIuNzg1LDQ1LjY0MSw0Mi43ODV6IE02NS4wODQsMzAuNjUzaC05Ljg5NWMtMC4xMDcsMy45NTktMS43OTcsNy41MjQtNC40NywxMC4wODggICBjNy4zNzUsMi4xOTMsMTIuNzcxLDkuMDMyLDEyLjc3MSwxNy4xMXYzLjc1OGM5Ljc3LTAuMzU4LDE1LjQtMy4xMjcsMTUuNzcxLTMuMzEzbDAuNzg1LTAuMzk4aDAuMDg0VjQ1LjY5OSAgIEM4MC4xMywzNy40MDMsNzMuMzgsMzAuNjUzLDY1LjA4NCwzMC42NTN6IE0yMC4wMzUsMjkuODUzYzIuMjk5LDAsNC40MzgtMC42NzEsNi4yNS0xLjgxNGMwLjU3Ni0zLjc1NywyLjU5LTcuMDQsNS40NjctOS4yNzYgICBjMC4wMTItMC4yMiwwLjAzMy0wLjQzOCwwLjAzMy0wLjY2YzAtNi40OTEtNS4yNjItMTEuNzUyLTExLjc1LTExLjc1MmMtNi40OTIsMC0xMS43NTIsNS4yNjEtMTEuNzUyLDExLjc1MiAgIEM4LjI4MywyNC41OTEsMTMuNTQzLDI5Ljg1MywyMC4wMzUsMjkuODUzeiBNMzAuNTg5LDQwLjc0MWMtMi42Ni0yLjU1MS00LjM0NC02LjA5Ny00LjQ2Ny0xMC4wMzIgICBjLTAuMzY3LTAuMDI3LTAuNzMtMC4wNTYtMS4xMDQtMC4wNTZoLTkuOTcxQzYuNzUsMzAuNjUzLDAsMzcuNDAzLDAsNDUuNjk5djEyLjE5N2wwLjAzMSwwLjE4OGwwLjg0LDAuMjY1ICAgYzYuMzUyLDEuOTgzLDEyLjAyMSwyLjg5NywxNi45NDUsMy4xODV2LTMuNjgzQzE3LjgxOCw0OS43NzMsMjMuMjEyLDQyLjkzNiwzMC41ODksNDAuNzQxeiIgZmlsbD0iIzAwMDAwMCIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=';



$oneuserd = 'data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCIgdmlld0JveD0iMCAwIDQwOS4xNjUgNDA5LjE2NCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDA5LjE2NSA0MDkuMTY0OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTIwNC41ODMsMjE2LjY3MWM1MC42NjQsMCw5MS43NC00OC4wNzUsOTEuNzQtMTA3LjM3OGMwLTgyLjIzNy00MS4wNzQtMTA3LjM3Ny05MS43NC0xMDcuMzc3ICAgIGMtNTAuNjY4LDAtOTEuNzQsMjUuMTQtOTEuNzQsMTA3LjM3N0MxMTIuODQ0LDE2OC41OTYsMTUzLjkxNiwyMTYuNjcxLDIwNC41ODMsMjE2LjY3MXoiIGZpbGw9IiMwMDAwMDAiLz4KCQk8cGF0aCBkPSJNNDA3LjE2NCwzNzQuNzE3TDM2MC44OCwyNzAuNDU0Yy0yLjExNy00Ljc3MS01LjgzNi04LjcyOC0xMC40NjUtMTEuMTM4bC03MS44My0zNy4zOTIgICAgYy0xLjU4NC0wLjgyMy0zLjUwMi0wLjY2My00LjkyNiwwLjQxNWMtMjAuMzE2LDE1LjM2Ni00NC4yMDMsMjMuNDg4LTY5LjA3NiwyMy40ODhjLTI0Ljg3NywwLTQ4Ljc2Mi04LjEyMi02OS4wNzgtMjMuNDg4ICAgIGMtMS40MjgtMS4wNzgtMy4zNDYtMS4yMzgtNC45My0wLjQxNUw1OC43NSwyNTkuMzE2Yy00LjYzMSwyLjQxLTguMzQ2LDYuMzY1LTEwLjQ2NSwxMS4xMzhMMi4wMDEsMzc0LjcxNyAgICBjLTMuMTkxLDcuMTg4LTIuNTM3LDE1LjQxMiwxLjc1LDIyLjAwNWM0LjI4NSw2LjU5MiwxMS41MzcsMTAuNTI2LDE5LjQsMTAuNTI2aDM2Mi44NjFjNy44NjMsMCwxNS4xMTctMy45MzYsMTkuNDAyLTEwLjUyNyAgICBDNDA5LjY5OSwzOTAuMTI5LDQxMC4zNTUsMzgxLjkwMiw0MDcuMTY0LDM3NC43MTd6IiBmaWxsPSIjMDAwMDAwIi8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==';

$icond = 'data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDU4IDU4IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1OCA1ODsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSIzMnB4IiBoZWlnaHQ9IjMycHgiPgo8Zz4KCTxwYXRoIGQ9Ik05LjUsNDNjLTIuNzU3LDAtNSwyLjI0My01LDVzMi4yNDMsNSw1LDVzNS0yLjI0Myw1LTVTMTIuMjU3LDQzLDkuNSw0M3ogTTkuNSw1MWMtMS42NTQsMC0zLTEuMzQ2LTMtM3MxLjM0Ni0zLDMtMyAgIHMzLDEuMzQ2LDMsM1MxMS4xNTQsNTEsOS41LDUxeiIgZmlsbD0iI0ZGRkZGRiIvPgoJPHBhdGggZD0iTTU2LjUsMzVjMC0yLjQ5NS0xLjM3NS0zLjY2Mi0yLjcxNS00LjIzM0M1NC44MzUsMjkuODUsNTUuNSwyOC41MDEsNTUuNSwyN2MwLTIuNzU3LTIuMjQzLTUtNS01SDM2LjEzNGwwLjcyOS0zLjQxICAgYzAuOTczLTQuNTQ5LDAuMzM0LTkuNzE2LDAuMTE2LTExLjE5MUMzNi40NjEsMy45MDYsMzMuMzcyLDAsMzAuMDEzLDBoLTAuMjM5QzI4LjE3OCwwLDI1LjUsMC45MDksMjUuNSw3ICAgYzAsOC4wMjMtMi4wMDIsMTEuNjk0LTMuNjgxLDEzLjM2Yy0xLjY0NywxLjYzNC0zLjIzMSwxLjYxNi0zLjMxOSwxLjY0aC0xdi0yaC0xNnYzOGgxNnYtMmgyOGMyLjc1NywwLDUtMi4yNDMsNS01ICAgYzAtMS4xNjQtMC40LTIuMjM2LTEuMDY5LTMuMDg3QzUxLjc0NSw0Ny40NzYsNTMuNSw0NS40MzksNTMuNSw0M2MwLTEuMTY0LTAuNC0yLjIzNi0xLjA2OS0zLjA4NyAgIEM1NC43NDUsMzkuNDc2LDU2LjUsMzcuNDM5LDU2LjUsMzV6IE0zLjUsNTZWMjJoMTJ2MzRIMy41eiBNNTEuNSwzOGgtM2gtOGMtMC41NTIsMC0xLDAuNDQ3LTEsMXMwLjQ0OCwxLDEsMWg4ICAgYzEuNjU0LDAsMywxLjM0NiwzLDNzLTEuMzQ2LDMtMywzaC0yaC0xaC03Yy0wLjU1MiwwLTEsMC40NDctMSwxczAuNDQ4LDEsMSwxaDdjMS42NTQsMCwzLDEuMzQ2LDMsM3MtMS4zNDYsMy0zLDNoLTI4VjI0ICAgbDAuOTY5LTAuMDAxYzAuMDk3LDAuMDE5LDIuNDIsMC4wNSw0LjY4Mi0yLjE0NEMyNi4wMzcsMTkuMDU5LDI3LjUsMTQuMDYxLDI3LjUsN2MwLTEuODY3LDAuMjk1LTUsMi4yNzQtNWgwLjIzOSAgIEMzMi4yNDQsMiwzNC42MjEsNS4xMywzNSw3LjY5MWMwLjIwNywxLjM5MiwwLjgxLDYuMjYtMC4wOTMsMTAuNDhMMzMuNjYyLDI0SDUwLjVjMS42NTQsMCwzLDEuMzQ2LDMsM3MtMS4zNDYsMy0zLDNoLTJoLTFoLTcgICBjLTAuNTUyLDAtMSwwLjQ0Ny0xLDFzMC40NDgsMSwxLDFoN2MwLjg4MywwLDIuODI1LDAuMDQsMy44NTQsMC4xOTNDNTMuOTY1LDMyLjU4LDU0LjUsMzMuNTk1LDU0LjUsMzUgICBDNTQuNSwzNi42NTQsNTMuMTU0LDM4LDUxLjUsMzh6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==';


$iconf = 'data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDU4IDU4IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1OCA1ODsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSIzMnB4IiBoZWlnaHQ9IjMycHgiPgo8Zz4KCTxwYXRoIGQ9Ik00MC41LDB2MmgtMjhjLTIuNzU3LDAtNSwyLjI0My01LDVjMCwxLjE2NCwwLjQsMi4yMzYsMS4wNjksMy4wODdDNi4yNTUsMTAuNTI0LDQuNSwxMi41NjEsNC41LDE1ICAgYzAsMS4xNjQsMC40LDIuMjM2LDEuMDY5LDMuMDg3QzMuMjU1LDE4LjUyNCwxLjUsMjAuNTYxLDEuNSwyM2MwLDIuNDk1LDEuMzc1LDMuNjYyLDIuNzE1LDQuMjMzQzMuMTY1LDI4LjE1LDIuNSwyOS40OTksMi41LDMxICAgYzAsMi43NTcsMi4yNDMsNSw1LDVoMTQuMzY2bC0wLjcyOSwzLjQxYy0wLjk3Myw0LjU1MS0wLjMzNCw5LjcxNy0wLjExNiwxMS4xOTFDMjEuNTM5LDU0LjA5NCwyNC42MjgsNTgsMjcuOTg3LDU4aDAuMjM5ICAgYzEuNTk2LDAsNC4yNzQtMC45MDksNC4yNzQtN2MwLTguMDIzLDIuMDAyLTExLjY5NCwzLjY4MS0xMy4zNmMxLjY0Ny0xLjYzNCwzLjIzNi0xLjYxMywzLjMxOS0xLjY0aDF2MmgxNlYwSDQwLjV6IE0zOS41MzEsMzQuMDAxICAgYy0wLjA5Mi0wLjAwOC0yLjQxOS0wLjA0OS00LjY4MiwyLjE0NEMzMS45NjMsMzguOTQxLDMwLjUsNDMuOTM5LDMwLjUsNTFjMCwxLjg2Ny0wLjI5NSw1LTIuMjc0LDVoLTAuMjM5ICAgYy0yLjIzMSwwLTQuNjA4LTMuMTMtNC45ODgtNS42OTFjLTAuMjA3LTEuMzkyLTAuODEtNi4yNTgsMC4wOTMtMTAuNDhMMjQuMzM5LDM0SDcuNWMtMS42NTQsMC0zLTEuMzQ2LTMtM3MxLjM0Ni0zLDMtM2gyaDFoNyAgIGMwLjU1MiwwLDEtMC40NDcsMS0xcy0wLjQ0OC0xLTEtMWgtN2MtMC44ODMsMC0yLjgyNS0wLjA0LTMuODU0LTAuMTkzQzQuMDM1LDI1LjQyLDMuNSwyNC40MDUsMy41LDIzYzAtMS42NTQsMS4zNDYtMywzLTNoM2g4ICAgYzAuNTUyLDAsMS0wLjQ0NywxLTFzLTAuNDQ4LTEtMS0xaC04Yy0xLjY1NCwwLTMtMS4zNDYtMy0zczEuMzQ2LTMsMy0zaDJoMWg3YzAuNTUyLDAsMS0wLjQ0NywxLTFzLTAuNDQ4LTEtMS0xaC03ICAgYy0xLjY1NCwwLTMtMS4zNDYtMy0zczEuMzQ2LTMsMy0zaDI4djMwTDM5LjUzMSwzNC4wMDF6IE01NC41LDM2aC0xMlYyaDEyVjM2eiIgZmlsbD0iI0ZGRkZGRiIvPgoJPHBhdGggZD0iTTQ4LjUsMTVjMi43NTcsMCw1LTIuMjQzLDUtNXMtMi4yNDMtNS01LTVzLTUsMi4yNDMtNSw1UzQ1Ljc0MywxNSw0OC41LDE1eiBNNDguNSw3YzEuNjU0LDAsMywxLjM0NiwzLDNzLTEuMzQ2LDMtMywzICAgcy0zLTEuMzQ2LTMtM1M0Ni44NDYsNyw0OC41LDd6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==';



$iconc = 'data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCIgdmlld0JveD0iMCAwIDQ1Ni43OTUgNDU2Ljc5NSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDU2Ljc5NSA0NTYuNzk1OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTQ0OC45NDcsMjE4LjQ3NWMtMC45MjItMS4xNjgtMjMuMDU1LTI4LjkzMy02MS01Ni44MWMtNTAuNzA1LTM3LjI1My0xMDUuODc3LTU2Ljk0NC0xNTkuNTUxLTU2Ljk0NCAgICBjLTUzLjY3MiwwLTEwOC44NDQsMTkuNjkxLTE1OS41NTEsNTYuOTQ0Yy0zNy45NDQsMjcuODc2LTYwLjA3Nyw1NS42NDItNjEsNTYuODFMMCwyMjguMzk3bDcuODQ2LDkuOTIzICAgIGMwLjkyMywxLjE2OCwyMy4wNTYsMjguOTM0LDYxLDU2LjgxMWM1MC43MDcsMzcuMjUyLDEwNS44NzksNTYuOTQzLDE1OS41NTEsNTYuOTQzYzUzLjY3MywwLDEwOC44NDUtMTkuNjkxLDE1OS41NS01Ni45NDMgICAgYzM3Ljk0NS0yNy44NzcsNjAuMDc4LTU1LjY0Myw2MS01Ni44MTFsNy44NDgtOS45MjNMNDQ4Ljk0NywyMTguNDc1eiBNMjI4LjM5NiwzMTUuMDM5Yy00Ny43NzQsMC04Ni42NDItMzguODY3LTg2LjY0Mi04Ni42NDIgICAgYzAtNy40ODUsMC45NTQtMTQuNzUxLDIuNzQ3LTIxLjY4NGwtMTkuNzgxLTMuMzI5Yy0xLjkzOCw4LjAyNS0yLjk2NiwxNi40MDEtMi45NjYsMjUuMDEzYzAsMzAuODYsMTMuMTgyLDU4LjY5NiwzNC4yMDQsNzguMTg3ICAgIGMtMjcuMDYxLTkuOTk2LTUwLjA3Mi0yNC4wMjMtNjcuNDM5LTM2LjcwOWMtMjEuNTE2LTE1LjcxNS0zNy42NDEtMzEuNjA5LTQ2LjgzNC00MS40NzhjOS4xOTctOS44NzIsMjUuMzItMjUuNzY0LDQ2LjgzNC00MS40NzggICAgYzE3LjM2Ny0xMi42ODYsNDAuMzc5LTI2LjcxMyw2Ny40MzktMzYuNzFsMTMuMjcsMTQuOTU4YzE1LjQ5OC0xNC41MTIsMzYuMzEyLTIzLjQxMiw1OS4xNjgtMjMuNDEyICAgIGM0Ny43NzQsMCw4Ni42NDEsMzguODY3LDg2LjY0MSw4Ni42NDJDMzE1LjAzNywyNzYuMTcyLDI3Ni4xNywzMTUuMDM5LDIyOC4zOTYsMzE1LjAzOXogTTM2OC4yNzMsMjY5Ljg3NSAgICBjLTE3LjM2OSwxMi42ODYtNDAuMzc5LDI2LjcxMy02Ny40MzksMzYuNzA5YzIxLjAyMS0xOS40OSwzNC4yMDMtNDcuMzI2LDM0LjIwMy03OC4xODhzLTEzLjE4Mi01OC42OTctMzQuMjAzLTc4LjE4OCAgICBjMjcuMDYxLDkuOTk3LDUwLjA3LDI0LjAyNCw2Ny40MzksMzYuNzFjMjEuNTE2LDE1LjcxNSwzNy42NDEsMzEuNjA5LDQ2LjgzNCw0MS40NzcgICAgQzQwNS45MSwyMzguMjY5LDM4OS43ODcsMjU0LjE2MiwzNjguMjczLDI2OS44NzV6IiBmaWxsPSIjRkZGRkZGIi8+CgkJPHBhdGggZD0iTTE3My4yNjEsMjExLjU1NWMtMS42MjYsNS4zMjktMi41MDcsMTAuOTgyLTIuNTA3LDE2Ljg0M2MwLDMxLjgzNCwyNS44MDcsNTcuNjQyLDU3LjY0Miw1Ny42NDIgICAgYzMxLjgzNCwwLDU3LjY0MS0yNS44MDcsNTcuNjQxLTU3LjY0MnMtMjUuODA3LTU3LjY0Mi01Ny42NDEtNTcuNjQyYy0xNS41MDYsMC0yOS41NzEsNi4xMzQtMzkuOTMyLDE2LjA5NGwyOC40MzIsMzIuMDQ4ICAgIEwxNzMuMjYxLDIxMS41NTV6IiBmaWxsPSIjRkZGRkZGIi8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==';





$icong = 'data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCIgdmlld0JveD0iMCAwIDgwLjEzIDgwLjEzIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA4MC4xMyA4MC4xMzsiIHhtbDpzcGFjZT0icHJlc2VydmUiPgo8Zz4KCTxwYXRoIGQ9Ik00OC4zNTUsMTcuOTIyYzMuNzA1LDIuMzIzLDYuMzAzLDYuMjU0LDYuNzc2LDEwLjgxN2MxLjUxMSwwLjcwNiwzLjE4OCwxLjExMiw0Ljk2NiwxLjExMiAgIGM2LjQ5MSwwLDExLjc1Mi01LjI2MSwxMS43NTItMTEuNzUxYzAtNi40OTEtNS4yNjEtMTEuNzUyLTExLjc1Mi0xMS43NTJDNTMuNjY4LDYuMzUsNDguNDUzLDExLjUxNyw0OC4zNTUsMTcuOTIyeiBNNDAuNjU2LDQxLjk4NCAgIGM2LjQ5MSwwLDExLjc1Mi01LjI2MiwxMS43NTItMTEuNzUycy01LjI2Mi0xMS43NTEtMTEuNzUyLTExLjc1MWMtNi40OSwwLTExLjc1NCw1LjI2Mi0xMS43NTQsMTEuNzUyUzM0LjE2Niw0MS45ODQsNDAuNjU2LDQxLjk4NCAgIHogTTQ1LjY0MSw0Mi43ODVoLTkuOTcyYy04LjI5NywwLTE1LjA0Nyw2Ljc1MS0xNS4wNDcsMTUuMDQ4djEyLjE5NWwwLjAzMSwwLjE5MWwwLjg0LDAuMjYzICAgYzcuOTE4LDIuNDc0LDE0Ljc5NywzLjI5OSwyMC40NTksMy4yOTljMTEuMDU5LDAsMTcuNDY5LTMuMTUzLDE3Ljg2NC0zLjM1NGwwLjc4NS0wLjM5N2gwLjA4NFY1Ny44MzMgICBDNjAuNjg4LDQ5LjUzNiw1My45MzgsNDIuNzg1LDQ1LjY0MSw0Mi43ODV6IE02NS4wODQsMzAuNjUzaC05Ljg5NWMtMC4xMDcsMy45NTktMS43OTcsNy41MjQtNC40NywxMC4wODggICBjNy4zNzUsMi4xOTMsMTIuNzcxLDkuMDMyLDEyLjc3MSwxNy4xMXYzLjc1OGM5Ljc3LTAuMzU4LDE1LjQtMy4xMjcsMTUuNzcxLTMuMzEzbDAuNzg1LTAuMzk4aDAuMDg0VjQ1LjY5OSAgIEM4MC4xMywzNy40MDMsNzMuMzgsMzAuNjUzLDY1LjA4NCwzMC42NTN6IE0yMC4wMzUsMjkuODUzYzIuMjk5LDAsNC40MzgtMC42NzEsNi4yNS0xLjgxNGMwLjU3Ni0zLjc1NywyLjU5LTcuMDQsNS40NjctOS4yNzYgICBjMC4wMTItMC4yMiwwLjAzMy0wLjQzOCwwLjAzMy0wLjY2YzAtNi40OTEtNS4yNjItMTEuNzUyLTExLjc1LTExLjc1MmMtNi40OTIsMC0xMS43NTIsNS4yNjEtMTEuNzUyLDExLjc1MiAgIEM4LjI4MywyNC41OTEsMTMuNTQzLDI5Ljg1MywyMC4wMzUsMjkuODUzeiBNMzAuNTg5LDQwLjc0MWMtMi42Ni0yLjU1MS00LjM0NC02LjA5Ny00LjQ2Ny0xMC4wMzIgICBjLTAuMzY3LTAuMDI3LTAuNzMtMC4wNTYtMS4xMDQtMC4wNTZoLTkuOTcxQzYuNzUsMzAuNjUzLDAsMzcuNDAzLDAsNDUuNjk5djEyLjE5N2wwLjAzMSwwLjE4OGwwLjg0LDAuMjY1ICAgYzYuMzUyLDEuOTgzLDEyLjAyMSwyLjg5NywxNi45NDUsMy4xODV2LTMuNjgzQzE3LjgxOCw0OS43NzMsMjMuMjEyLDQyLjkzNiwzMC41ODksNDAuNzQxeiIgZmlsbD0iI0ZGRkZGRiIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=';



 ?>



<?php


if(!empty($counter_id) && !empty($app_token))

{



    $date = new JDate();

    $date2 = $date->format('Ymd');



    if($date_diapazon == 'week')

    {

        $date->modify('-7 day');

    }

    else

    {

        $date->modify('-'.$date_diapazon.' month');

    }

    $date1 = $date->format('Ymd');



    $url = 'http://api-metrika.yandex.ru/stat/traffic/summary.json?id='.$counter_id;

    $url .= '&date1='.$date1;

    $url .= '&date2='.$date2;

    $url .= '&group='.$date_group;

    $url .= '&per_page=500';

    $url .= '&oauth_token='.$app_token;



    $responce = MetrikaHelper::open_http($url, $method);

    $data = json_decode($responce);


    $urlpopular = 'http://api-metrika.yandex.ru/stat/content/popular.json?id='.$counter_id;

    $urlpopular .= '&date1='.$date1;

    $urlpopular .= '&date2='.$date2;

    $urlpopular .= '&per_page='.$perpagepopular;

    $urlpopular .= '&oauth_token='.$app_token;



    $responcepopular = MetrikaHelper::open_http($urlpopular, $method);

    $datapopular = json_decode($responcepopular);


// HACK: fix minus 1 day

$ModDate1 = new DateTime($date1);
$ModDate1->modify('-1 day');
$ModDate1 = $ModDate1->format('Ymd');

$ModDate2 = new DateTime($date2);
$ModDate2->modify('-1 day');
$ModDate2 = $ModDate2->format('Ymd');



    $urlgeo = 'http://api-metrika.yandex.ru/stat/geo.json?id='.$counter_id;

    $urlgeo .= '&date1='.$ModDate1;

    $urlgeo .= '&date2='.$ModDate2;

    $urlgeo .= '&per_page=12';

    $urlgeo .= '&oauth_token='.$app_token;



    $responcegeo = MetrikaHelper::open_http($urlgeo, $method);

    $datageo = json_decode($responcegeo);





    $urlsvodka = 'http://api-metrika.yandex.ru/stat/sources/summary.json?id='.$counter_id;

    $urlsvodka .= '&date1='.$date1;

    $urlsvodka .= '&date2='.$date2;

    $urlsvodka .= '&per_page=12';

    $urlsvodka .= '&oauth_token='.$app_token;



    $responcesvodka = MetrikaHelper::open_http($urlsvodka, $method);

    $datasvodka = json_decode($responcesvodka);



    $now_date = date('Y-m-d');

    $cur_date = date('Y-m-d', strtotime($now_date));

    //echo 'Сегодня '.$cur_date.'<br>';

    $date = new DateTime($cur_date);

    $date->modify('-1 day');

    $vchera = $date->format('Y-m-d');

    $date = new DateTime($cur_date);

    $date->modify('-2 day');

    $pozavchera = $date->format('Y-m-d');

    $date = new DateTime($cur_date);

    $date->modify('-3 day');

    $pozapozavchera = $date->format('Y-m-d');

    $date = new DateTime($cur_date);

    $date->modify('-4 day');

    $pozapozapozavchera = $date->format('Y-m-d');

    $date = new DateTime($cur_date);

    $date->modify('-5 day');

    $pozapozapozapozavchera = $date->format('Y-m-d');





$urlpozapozapozavchera = 'http://api-metrika.yandex.ru/stat/sources/summary.json?id='.$counter_id;

$urlpozapozapozavchera .= '&date1='.$pozapozapozavchera;

$urlpozapozapozavchera .= '&date2='.$pozapozapozapozavchera;

$urlpozapozapozavchera .= '&per_page=12';

$urlpozapozapozavchera .= '&oauth_token='.$app_token;



$responcepozapozapozavchera = MetrikaHelper::open_http($urlpozapozapozavchera, $method);

$datapozapozapozavchera = json_decode($responcepozapozapozavchera);





$urlpozapozavchera = 'http://api-metrika.yandex.ru/stat/sources/summary.json?id='.$counter_id;

$urlpozapozavchera .= '&date1='.$pozapozavchera;

$urlpozapozavchera .= '&date2='.$pozapozavchera;

$urlpozapozavchera .= '&per_page=12';

$urlpozapozavchera .= '&oauth_token='.$app_token;



$responcepozapozavchera = MetrikaHelper::open_http($urlpozapozavchera, $method);

$datapozapozavchera = json_decode($responcepozapozavchera);





$urlpozavchera = 'http://api-metrika.yandex.ru/stat/sources/summary.json?id='.$counter_id;

$urlpozavchera .= '&date1='.$pozavchera;

$urlpozavchera .= '&date2='.$pozavchera;

$urlpozavchera .= '&per_page=12';

$urlpozavchera .= '&oauth_token='.$app_token;



$responcepozavchera = MetrikaHelper::open_http($urlpozavchera, $method);

$datapozavchera = json_decode($responcepozavchera);







$urlvchera = 'http://api-metrika.yandex.ru/stat/sources/summary.json?id='.$counter_id;

$urlvchera .= '&date1='.$vchera;

$urlvchera .= '&date2='.$vchera;

$urlvchera .= '&per_page=12';

$urlvchera .= '&oauth_token='.$app_token;



$responcevchera = MetrikaHelper::open_http($urlvchera, $method);

$datavchera = json_decode($responcevchera);







$urlcurdate = 'http://api-metrika.yandex.ru/stat/sources/summary.json?id='.$counter_id;

$urlcurdate .= '&date1='.$cur_date;

$urlcurdate .= '&date2='.$cur_date;

$urlcurdate .= '&per_page=12';

$urlcurdate .= '&oauth_token='.$app_token;



$responcecurdate = MetrikaHelper::open_http($urlcurdate, $method);

$datacurdate = json_decode($responcecurdate);



  //  dump($datapopular,0,'Популярные статьи');

//https://tech.yandex.ru/metrika/doc/ref/stat/geo-docpage/


    if(!is_null($data) && is_array($data->data) && count($data->data))

    {

        $document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/amcharts/amcharts/amcharts.js');

        $document->addScript(JUri::root() . 'administrator/components/com_myjbzoostat/assets/amcharts/amcharts/serial.js');

        $document->addScript(JUri::root() . 'administrator/components/com_myjbzoostat/assets/amcharts/amcharts/lang/ru.js');


        $dataValues = array();

        foreach($data->data as $v)

        {

            $dataValues[$v->date] = $v;

        }



        ksort ($dataValues);

        $countData = count($dataValues);



        $totals = (isset($data->totals)) ? $data->totals : null;

        $denial = (isset($totals->denial)) ? $totals->denial : 0;

        $visits = (isset($totals->visits)) ? $totals->visits : 0;

        $new_visitors_perc = (isset($totals->new_visitors_perc)) ? $totals->new_visitors_perc : 0;

        $page_views = (isset($totals->page_views)) ? $totals->page_views : 0;

        $visit_time = (isset($totals->visit_time)) ? $totals->visit_time : 0;

        $depth = (isset($totals->depth)) ? $totals->depth : 0;

        $new_visitors = (isset($totals->new_visitors)) ? $totals->new_visitors : 0;

        $visitors = (isset($totals->visitors)) ? $totals->visitors : 0;



        $chartData = '[ ';

        foreach($dataValues as $value)

        {

            $date = $value->date;

            $valDate = substr($date,0,4).'-'.substr($date,4,2).'-'.substr($date,6,2);

            $chartData .= "\n".'            { "date": "'.$valDate.'", "visits": '.$value->visits.', "page_views": '.$value->page_views.' , "new_visitors": '.$value->new_visitors.'  , "visitors": '.$value->visitors.' },';

        }



        $chartData .= "\n".'        ]';



        $script = <<<SCRIPT

           var chart;

           var line_chartData = $chartData;



           AmCharts.ready(function () {



               // SERIAL CHART

               chart = new AmCharts.AmSerialChart();

               chart.pathToImages = "/administrator/components/com_myjbzoostat/assets/amcharts/amcharts/images/";

               chart.dataProvider = line_chartData;

               chart.categoryField = "date";

               chart.language = "ru";



               // listen for "dataUpdated" event (fired when chart is inited) and call zoomChart method when it happens

               chart.addListener("dataUpdated", zoomChart);



               // AXES

               // category

               var categoryAxis = chart.categoryAxis;

               categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true

               //categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD

               categoryAxis.minorGridEnabled = true;

               categoryAxis.autoGridCount = false;

               //categoryAxis.gridCount = 1;

               //categoryAxis.axisColor = "#DADADA";



               var graph;

SCRIPT;

        // GRAPHS

        if($show_visits){

            $script .= <<<SCRIPT

               graph = new AmCharts.AmGraph();

               graph.title = "Визиты";

               graph.valueField = "visits";

               graph.lineThickness = 2;

               graph.bullet = "round";

               graph.bulletSize = 5;

               graph.hideBulletsCount = 30;

               graph.bulletBorderThickness = 1;

               chart.addGraph(graph);



SCRIPT;

        }

        if($show_page_views){

            $script .= <<<SCRIPT

               graph = new AmCharts.AmGraph();

               graph.title = "Просмотры страниц \u00A0 \u00A0 ";

               graph.valueField = "page_views";

               graph.lineThickness = 2;

               graph.bullet = "round";

               graph.bulletSize = 5;

               graph.hideBulletsCount = 30;

               graph.bulletBorderThickness = 1;

               chart.addGraph(graph);



SCRIPT;

        }

        if($show_new_visitors){

            $script .= <<<SCRIPT

               graph = new AmCharts.AmGraph();

               graph.title = "Новые посетители";

               graph.valueField = "new_visitors";

               graph.lineThickness = 2;

               graph.bullet = "round";

               graph.bulletSize = 5;

               graph.hideBulletsCount = 30;

               graph.bulletBorderThickness = 1;

               chart.addGraph(graph);



SCRIPT;

        }

        if($show_visitors){

            $script .= <<<SCRIPT

               graph = new AmCharts.AmGraph();

               graph.title = "Посетители";

               graph.valueField = "visitors";

               graph.lineThickness = 2;

               graph.bullet = "round";

               graph.bulletSize = 5;

               graph.hideBulletsCount = 30;

               graph.bulletBorderThickness = 1;

               chart.addGraph(graph);



SCRIPT;

        }



        $script .= <<<SCRIPT



               // CURSOR

               var chartCursor = new AmCharts.ChartCursor();

               chartCursor.cursorPosition = "mouse";

               chart.addChartCursor(chartCursor);



               // SCROLLBAR

               var chartScrollbar = new AmCharts.ChartScrollbar();

               chart.addChartScrollbar(chartScrollbar);



               // LEGEND

               var legend = new AmCharts.AmLegend();

               legend.marginLeft = 110;

               legend.useGraphSettings = true;

               chart.addLegend(legend);



               // WRITE

               chart.write("line_chartdiv");

           });





           function zoomChart() {



               chart.zoomToIndexes(0, $countData);

           }

SCRIPT;



        $document->addScriptDeclaration($script);





    }

    else{

        echo $responce;

        echo $responcepopular;

    }

}





 ?>







 <div class="item-page">



<div id="line_chartdiv" style="width:100%; height:<?php echo $height; ?>px;"></div>



<?php



    function bd_nice_number($n) {



        $n = (0+str_replace(",","",$n));



        if(!is_numeric($n)) return false;



        if($n>1000000) return round(($n/1000000),3).' тыс';

        else if($n>1000) return round(($n/1000),0).'+ тыc.';



        return number_format($n);

    }





if ($datageo) {



  $datebegin = $datageo->date1;

  $datebegin = date("d.m.Y", strtotime($datebegin));

  $dateend = $datageo->date2;

  $dateend = date("d.m.Y", strtotime($dateend));

  //total

  $globalpageviews = $datageo->totals->page_views;

  $globalvisits = $datageo->totals->visits;



}




?>



<?php

echo "<h2 align='center'>Статистика: с {$datebegin} по {$dateend}</h2>";



$daytosql = date('Ymd');



echo "<span class='span6'>";



echo "<div class='pageview'>";

$globalgv = bd_nice_number($globalpageviews);

$globalvis = bd_nice_number($globalvisits);

if (preg_match('/тыс/',$globalgv,$matchs) || preg_match('/тыс/',$globalvis,$matchs) ) {

  $globalgv = str_replace('.',' млн. ',$globalgv);

  $globalgv = $globalgv.'.';

  $globalvis = str_replace('.',' млн. ',$globalvis);

  $globalvis = $globalvis.'.';



}

echo "<span title='{$globalpageviews}' class='countview'>{$globalgv}</span>";



echo "<span class='textstat'>Просмотров страниц</span>";

echo "</div>";



echo "</span>";





echo "<span class='span6'>";



echo "<div class='visitors'>";

echo "<span title='{$globalvisits}' class='globvisitors'>{$globalvis}</span>";

echo "<span class='textstat'>Посетителей</span>";

echo "</div>";



echo "</span>";

echo "<div class='allinoneline span12'>";

if ($datasvodka) {

$CountYaBlocks = count($datasvodka->data);

$CountYaBlocksdata = $datasvodka->data;
$checkyaarray = array();
foreach ($CountYaBlocksdata as $CountYaBlocksdataaas) {
  $nameneop = $CountYaBlocksdataaas->name;
  if (preg_match('/Неопределён/', $nameneop, $matchneopr)) {
    $checkyaarray = $matchneopr;
    $block = 0;
  }
  if (empty($checkyaarray)) {
    $block = 1;
  }
}


$CountYaBlocks = ($CountYaBlocks + $block) - 3;


  $datasvodka = $datasvodka->data;



  foreach ($datasvodka as $key => $valuesvodka) {



    $namesvod =      $valuesvodka->name;




  $pryamiezahodi = $valuesvodka->page_views;

  $visitspryamie = $valuesvodka->visits;



  $globalzahodi = bd_nice_number($pryamiezahodi);

  $globalpryamie = bd_nice_number($visitspryamie);



    if (preg_match('/тыс/',$globalzahodi,$matchs) || preg_match('/тыс/',$globalpryamie,$matchs)) {

      $globalzahodi = str_replace('.',' млн. ',$globalzahodi);

      $globalzahodi = $globalzahodi.'.';

      $globalzahodi = str_replace('тыc млн. .','тыc.', $globalzahodi);

      $globalpryamie = str_replace('.',' млн. ',$globalpryamie);

      $globalpryamie = $globalpryamie.'.';

      $globalpryamie = str_replace('тыc млн. .','тыc.', $globalpryamie);

      // dump($globalpryamie,0,'$globalpryamie');

    }

        $namesvodarr = array('Переходы с сохранённых страниц', 'Неопределён', 'Внутренние переходы');

      if (!in_array($namesvod, $namesvodarr)) {

if ($CountYaBlocks == '6') {
  $gridmyrow = 'center myspan2 span2';
}

if ($CountYaBlocks == '5') {
  $gridmyrow = 'center myspan25';
}

if ($CountYaBlocks == '4') {
  $gridmyrow = 'center myspan3 span3';
}

if ($CountYaBlocks == '3') {
  $gridmyrow = 'center myspan3 span3';
}


      echo '<div class="'.$gridmyrow.' bigmonthdata">';



      echo ' <img src='.$iconc.' /> ';



      echo $globalzahodi;

      echo ' <img src="'.$icong.'" /> ';

      echo $globalpryamie;



      echo '<div class="nameotch">'.$namesvod = $valuesvodka->name.'</div>';

      echo '</div>';





    }



    // dump($valuesvodka,0,'Сводка');



  }



}




echo "</div>";






?>


<hr>


<?php



echo "<div class='tagsstat country'>";

echo "<ul class='zebra country'>";





if ($datageo) {



  $geoyandex = $datageo->data;



  foreach ($geoyandex as $key => $valueobjgeo) {

    //dump($valueobjgeo,0,'$valueobjgeo');

      $namecountry = $valueobjgeo->name;

      $countrypw = $valueobjgeo->page_views;

      $countyvis = $valueobjgeo->visits;



    echo "<li><span>{$namecountry}</span> <span><img src='{$eyed}' /> {$countrypw} </span> <span> <img src='{$usersd}' /> {$countyvis} </span> </li>";

}

}

echo "</ul>";

echo "</div>";





?>



<h3>Статистика за месяц:</h3>



<!-- Статистика по статьям - по времени публикации -->



<div class="row-fluid tagsstat">

<?php

$today_date = date("d.m.Y");



echo "<ul class='zebra'>";

$dataValues = array_reverse($dataValues);

$dateimod = 0;

foreach($dataValues as $value)

{

    $date = $value->date;

    $valDate = substr($date,0,4).'-'.substr($date,4,2).'-'.substr($date,6,2);

    $date    = $valDate;

    $today_date = date("d.m.Y");

    $newdateformat = date("d.m.Y", strtotime("+0 seconds", strtotime($date)));

    $visits  = $value->visits;

    $page_views = $value->page_views;

    $new_visitors = $value->new_visitors;

    $visitors     = $value->visitors;

    $classbest = '';

    // HACK:

    $newdateformatsql =  date("Y-m-d", strtotime("+0 seconds", strtotime($date)));

    $newdateformatsqlmodal =  date("Ymd", strtotime("+0 seconds", strtotime($date)));

    $newdateformatsqlgood =  date("d.m.Y", strtotime("+0 seconds", strtotime($date)));


    if (JComponentHelper::isEnabled('com_zoo') == '1' && $comcontent != 'yes') {

        $articlesmonthmoreday = "SELECT id,name,publish_up"

            ." FROM " . ZOO_TABLE_ITEM

            ." WHERE publish_up BETWEEN '".$newdateformatsql." 00:00:00' AND '".$newdateformatsql." 23:59:59'";



        $db->setQuery($articlesmonthmoreday);

        $itemIdsResultsdatemonthDAY = $db->loadObjectList();

        $arrayNameday = array($itemIdsResultsdatemonthDAY);



        $itemIdsday = array();

        foreach ($itemIdsResultsdatemonthDAY as $keynamed => $valuedayday) {



              $itemIdsdayidday[] = $valuedayday->id;

              $itemIdsdayname[] = $valuedayday->name;

              $itemIdsday[] = date(' H:i', strtotime("+0 hours", strtotime($valuedayday->publish_up)));

            }


$idpublisharray = implode('<li>',$itemIdsday);

$arrayNameday = $arrayNameday['0'];

$arrayNamedaycount = count($arrayNameday);


          if (empty($arrayNamedaycount) || $arrayNamedaycount == '0') {

            $valdatestat = '';

          }

          else {

            echo '<script>jQuery(document).ready(function($) {

              document.querySelector(".message-html'.$newdateformatsqlmodal.'").onclick = function(){

              	swal({

              		title: "Дата публикаций за: '.$newdateformatsqlgood.'",

              		text: "<ul><li>'.$idpublisharray.'</ul>",

              		html: true

              	});

              };

	           });

                              </script>';





             $valdatestat = '<a href="#" class="message-html'.$newdateformatsqlmodal.'"><span class="articlesinthisday">('. $arrayNamedaycount . ')</span></a>';



          }

}


if ($comcontent == 'yes') {

    $articlesmonthmoreday = "SELECT id,title,created"

        ." FROM #__content"

        ." WHERE created BETWEEN '".$newdateformatsql." 00:00:00' AND '".$newdateformatsql." 23:59:59'";

                $db->setQuery($articlesmonthmoreday);

                $itemIdsResultsdatemonthDAY = $db->loadObjectList();

                $arrayNameday = array($itemIdsResultsdatemonthDAY);



                $itemIdsday = array();

                foreach ($itemIdsResultsdatemonthDAY as $keynamed => $valuedayday) {
// dump($valuedayday,0,'$arrayNameday');
                      $itemIdsdayidday[] = $valuedayday->id;

                      $itemIdsdayname[] = $valuedayday->title;

                      $itemIdsday[] = date(' H:i', strtotime("+0 hours", strtotime($valuedayday->created)));

                    }


        $idpublisharray = implode('<li>',$itemIdsday);

        $arrayNameday = $arrayNameday['0'];

        $arrayNamedaycount = count($arrayNameday);


                  if (empty($arrayNamedaycount) || $arrayNamedaycount == '0') {

                    $valdatestat = '';

                  }

                  else {

                    echo '<script>jQuery(document).ready(function($) {

                      document.querySelector(".message-html'.$newdateformatsqlmodal.'").onclick = function(){

                      	swal({

                      		title: "Дата публикаций за: '.$newdateformatsqlgood.'",

                      		text: "<ul><li>'.$idpublisharray.'</ul>",

                      		html: true

                      	});

                      };

        	           });

                                      </script>';





                     $valdatestat = '<a href="#" class="message-html'.$newdateformatsqlmodal.'"><span class="articlesinthisday">('. $arrayNamedaycount . ')</span></a>';



                  }

        }




    if ($today_date == $newdateformat) {



        $svgpulse = '<span class="svgpul"><svg width="32" height="20" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg" fill="#ccc">

          <g transform="matrix(1 0 0 -1 0 80)">

              <rect width="10" height="20" rx="3">

                  <animate attributeName="height"

                       begin="0s" dur="4.3s"

                       values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20" calcMode="linear"

                       repeatCount="indefinite" />

              </rect>

              <rect x="15" width="10" height="80" rx="3">

                  <animate attributeName="height"

                       begin="0s" dur="2s"

                       values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear"

                       repeatCount="indefinite" />

              </rect>

              <rect x="30" width="10" height="50" rx="3">

                  <animate attributeName="height"

                       begin="0s" dur="1.4s"

                       values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear"

                       repeatCount="indefinite" />

              </rect>

              <rect x="45" width="10" height="30" rx="3">

                  <animate attributeName="height"

                       begin="0s" dur="2s"

                       values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear"

                       repeatCount="indefinite" />

              </rect>

          </g>

      </svg></span> ';



    }

    else {

      $svgpulse = '';

    }



    if (trim($page_views) < $fillbad && $today_date != $newdateformat) {

        $classbest = " class='red' ";

    }



    if (trim($page_views) > $fillbad && trim($page_views) < $fillnorm) {

        $classbest = "  ";

    //      $supertext = "";

    }

    if (trim($page_views) > $fillnorm && trim($page_views) < $fillgood ) {

        $classbest = " class='bestday' ";

    //    $supertext = "";

    }



    if (trim($page_views) > $fillgood ) {

        $classbest = " class='vergood' ";

    //    $supertext = " ";

    //    $supertext = "<b style='color:red;'> &laquo; РЕКОРД &raquo;</b> ";

    }



    echo "<li {$classbest} ><span>{$newdateformat}</span> <span> <img src='{$eyed}' /> {$page_views} </span> <span>   <img src='{$usersd}' />  {$visits} </span>  <span> <img src='{$oneuserd}' />  {$visitors} </span> {$valdatestat}  {$svgpulse}  </li>";

}

echo "</ul>";

echo "<span class='allinfo span12 center'> <span class='span4'> <b> <img src='{$eyed}' />  Визиты:</b> Суммарное количество визитов.  </span>  <span class='span4'><b>   <img src='{$usersd}' />  Посетители:</b> Количество уникальных посетителей. </span> <span class='span4'><b> <img src='{$oneuserd}' /> Просмотры:</b> Число просмотров страниц на сайте за отчетный период. </span></span>";



 ?>



</div>

<div class='clrboth'></div>

<?php



$cssclasstoblock = '';



if ($datacurdate) {

  $datacurdatedate = $datacurdate->date1;

   $datacurdatedate = date("d.m.Y", strtotime("+0 seconds", strtotime($datacurdatedate)));

  $datacurdatetotals = $datacurdate->totals;

  $datacurdatetotalpv = $datacurdatetotals->page_views;

  $datacurdatetotalvis = $datacurdatetotals->visits;

  $datacurdate = $datacurdate->data;

  $datavcheratotals1 = $datavchera->totals;

  $datavcheratalpv1 = $datavcheratotals1->page_views;

  $checkdynamick = ($datacurdatetotalpv > $datavcheratalpv1) ? '<img src='.$icond.' />' : '<img src='.$iconf.' />' ;



  if ($valuesvodka->name == 'Прямые заходы') {

   $cssclasstoblock = 'background-color: #7E57C2;';

  }

  if ($valuesvodka->name == 'Переходы из поисковых систем') {

   $cssclasstoblock = 'background-color: #536DFE;';

  }

  if ($valuesvodka->name == 'Переходы из социальных сетей') {

   $cssclasstoblock = 'background-color: #EF5350;';

  }

  if ($valuesvodka->name == 'Переходы по ссылкам на сайтах') {

   $cssclasstoblock = 'background-color: #EC407A;';

  }


  if ($CountYaBlocks == '5') {
    $gridmyrow = 'center myspan2 span2';
  }

  if ($CountYaBlocks == '4') {
    $gridmyrow = 'center myspan25 span2';
  }

if ($CountYaBlocks == '3') {
  $gridmyrow = 'center myspan3 span3';
}

    echo '<div class="'.$gridmyrow.'  bigmonthdata todaystats" style="'.$cssclasstoblock.'">';

      echo ' <img src='.$iconc.' /> ';

      echo $datacurdatetotalpv;

          echo ' <img src="'.$icong.'" /> ';



  echo $datacurdatetotalvis;



  echo ' <svg width="32" height="20" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg" fill="#FFF">

    <g transform="matrix(1 0 0 -1 0 80)">

        <rect width="10" height="20" rx="3">

            <animate attributeName="height"

                 begin="0s" dur="4.3s"

                 values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20" calcMode="linear"

                 repeatCount="indefinite" />

        </rect>

        <rect x="15" width="10" height="80" rx="3">

            <animate attributeName="height"

                 begin="0s" dur="2s"

                 values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear"

                 repeatCount="indefinite" />

        </rect>

        <rect x="30" width="10" height="50" rx="3">

            <animate attributeName="height"

                 begin="0s" dur="1.4s"

                 values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear"

                 repeatCount="indefinite" />

        </rect>

        <rect x="45" width="10" height="30" rx="3">

            <animate attributeName="height"

                 begin="0s" dur="2s"

                 values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear"

                 repeatCount="indefinite" />

        </rect>

    </g>

</svg> ';



  if ($datacurdatedate != $today_date) { echo $checkdynamick;  }



  echo '<div class="nameotch">Посещаемость за: '.$datacurdatedate.'</div>';



    echo '</div>';



  foreach ($datacurdate as $key => $valuesvodka) {



    $namesvod =      $valuesvodka->name;



    $namesvodarr = array('Переходы с сохранённых страниц', 'Неопределён', 'Внутренние переходы');





  $pryamiezahodi = $valuesvodka->page_views;

  $visitspryamie = $valuesvodka->visits;



  $globalzahodi = bd_nice_number($pryamiezahodi);

  $globalpryamie = bd_nice_number($visitspryamie);



    if (preg_match('/тыс/',$globalzahodi,$matchs) || preg_match('/тыс/',$globalpryamie,$matchs)) {

      $globalzahodi = str_replace('.',' млн. ',$globalzahodi);

      $globalzahodi = $globalzahodi.'.';

      $globalpryamie = str_replace('.',' млн. ',$globalpryamie);

      $globalpryamie = $globalpryamie.'.';

    }





      if (!in_array($namesvod, $namesvodarr)) {

// dump($valuesvodka,0,'ds');







if ($valuesvodka->name == 'Прямые заходы') {

 $cssclasstoblock = 'background-color: #7E57C2;';

}

if ($valuesvodka->name == 'Переходы из поисковых систем') {

 $cssclasstoblock = 'background-color: #536DFE;';

}

if ($valuesvodka->name == 'Переходы из социальных сетей') {

 $cssclasstoblock = 'background-color: #EF5350;';

}

if ($valuesvodka->name == 'Переходы по ссылкам на сайтах') {

 $cssclasstoblock = 'background-color: #EC407A;';

}


  if ($CountYaBlocks == '5') {
    $gridmyrow = 'center myspan2 span2';
  }

  if ($CountYaBlocks == '4') {
    $gridmyrow = 'center myspan25 span2';
  }

if ($CountYaBlocks == '3') {
  $gridmyrow = 'center myspan3 span3';
}

    echo '<div class="'.$gridmyrow.' bigmonthdata todaystats" style="'.$cssclasstoblock.'">';



      echo ' <img src='.$iconc.' /> ';



      echo $pryamiezahodi;

      echo ' <img src="'.$icong.'" /> ';

      echo $visitspryamie;



      echo '<div class="nameotch">'.$namesvod = $valuesvodka->name.'</div>';



      echo '</div>';





    }



    // dump($valuesvodka,0,'Сводка');



  }



}





echo "<div class='clrboth'></div>";





if ($datavchera) {

  $datavcheradatedate = $datavchera->date1;

  $datavcheradatedate = date("d.m.Y", strtotime("+0 seconds", strtotime($datavcheradatedate)));

  $datavcheratotals = $datavchera->totals;

  $datavcheratalpv = $datavcheratotals->page_views;

  $datavcheratalvis = $datavcheratotals->visits;

  $datapozavcheratotals1 = $datapozavchera->totals;

  $daytotalpv1 = $datapozavcheratotals1->page_views;

  $daytotalvis1 = $datapozavcheratotals1->visits;

  $datavchera = $datavchera->data;

  $checkdynamick = ($datavcheratalpv > $daytotalpv1) ? '<img src='.$icond.' />' : '<img src='.$iconf.' />' ;


    if ($CountYaBlocks == '5') {
      $gridmyrow = 'center myspan2 span2';
    }

    if ($CountYaBlocks == '4') {
      $gridmyrow = 'center myspan25 span2';
    }

    if ($CountYaBlocks == '3') {
    	$gridmyrow = 'center myspan3 span3';
    }

      echo '<div class="'.$gridmyrow.'  bigmonthdata">';

    echo ' <img src='.$iconc.' /> ';

    echo $datavcheratalpv;

        echo ' <img src="'.$icong.'" /> ';



  echo $datavcheratalvis;

  if ($datavcheradatedate != $today_date) { echo $checkdynamick;  }



  echo '<div class="nameotch">Посещаемость за: '.$datavcheradatedate.'</div>';



  echo '</div>';



  foreach ($datavchera as $key => $valuesvodka) {



    $namesvod =      $valuesvodka->name;



    $namesvodarr = array('Переходы с сохранённых страниц', 'Неопределён', 'Внутренние переходы');





  $pryamiezahodi = $valuesvodka->page_views;

  $visitspryamie = $valuesvodka->visits;



  $globalzahodi = bd_nice_number($pryamiezahodi);

  $globalpryamie = bd_nice_number($visitspryamie);





    if (preg_match('/тыс/',$globalzahodi,$matchs) || preg_match('/тыс/',$globalpryamie,$matchs)) {

      $globalzahodi = str_replace('.',' млн. ',$globalzahodi);

      $globalzahodi = $globalzahodi.'.';

      $globalpryamie = str_replace('.',' млн. ',$globalpryamie);

      $globalpryamie = $globalpryamie.'.';

    }





      if (!in_array($namesvod, $namesvodarr)) {





          if ($valuesvodka->name == 'Прямые заходы') {

           $cssclasstoblock = 'background-color: #7E57C2;';

          }

          if ($valuesvodka->name == 'Переходы из поисковых систем') {

           $cssclasstoblock = 'background-color: #536DFE;';

          }

          if ($valuesvodka->name == 'Переходы из социальных сетей') {

           $cssclasstoblock = 'background-color: #EF5350;';

          }

          if ($valuesvodka->name == 'Переходы по ссылкам на сайтах') {

           $cssclasstoblock = 'background-color: #EC407A;';

          }




            if ($CountYaBlocks == '5') {
              $gridmyrow = 'center myspan2 span2';
            }

            if ($CountYaBlocks == '4') {
              $gridmyrow = 'center myspan25 span2';
            }

            if ($CountYaBlocks == '3') {
            	$gridmyrow = 'center myspan3 span3';
            }

      echo '<div class="'.$gridmyrow.'  bigmonthdata " style="'.$cssclasstoblock.'">';



      echo ' <img src='.$iconc.' /> ';



      echo $pryamiezahodi;

      echo ' <img src="'.$icong.'" /> ';

      echo $visitspryamie;



      echo '<div class="nameotch">'.$namesvod = $valuesvodka->name.'</div>';

      echo '</div>';





    }



    // dump($valuesvodka,0,'Сводка');



  }



}







echo "<div class='clrboth'></div>";





if ($datapozavchera) {

//  dump($datapozavchera,0,'Сводка');

  // dump($datapozavchera,0,'poza');

  $datapozavcheradatedate = $datapozavchera->date1;

  $datapozavcheradatedate = date("d.m.Y", strtotime("+0 seconds", strtotime($datapozavcheradatedate)));

  $datapozavcheratotals = $datapozavchera->totals;

  $daytotalpv = $datapozavcheratotals->page_views;

  $daytotalvis = $datapozavcheratotals->visits;

  $datadatapozapozavchera = $datapozapozavchera->totals;

  $datapozapozapv1 = $datadatapozapozavchera->page_views;

  $datapozapozavis1 = $datadatapozapozavchera->visits;





  $datapozavchera = $datapozavchera->data;



  $checkdynamick = ($daytotalpv > $datapozapozapv1) ? '<img src='.$icond.' />' : '<img src='.$iconf.' />' ;


    if ($CountYaBlocks == '5') {
      $gridmyrow = 'center myspan2 span2';
    }

    if ($CountYaBlocks == '4') {
      $gridmyrow = 'center myspan25 span2';
    }

    if ($CountYaBlocks == '3') {
    	$gridmyrow = 'center myspan3 span3';
    }

      echo '<div class="'.$gridmyrow.'   bigmonthdata">';

    echo ' <img src='.$iconc.' /> ';

    echo $daytotalpv;

        echo ' <img src="'.$icong.'" /> ';



echo $daytotalvis;

  if ($datapozavcheradatedate != $today_date) { echo $checkdynamick;  }



echo '<div class="nameotch">Посещаемость за: '.$datapozavcheradatedate.'</div>';



  echo '</div>';



  foreach ($datapozavchera as $key => $valuesvodka) {



    $namesvod =      $valuesvodka->name;



    $namesvodarr = array('Переходы с сохранённых страниц', 'Неопределён', 'Внутренние переходы');





  $pryamiezahodi = $valuesvodka->page_views;

  $visitspryamie = $valuesvodka->visits;



  $globalzahodi = bd_nice_number($pryamiezahodi);

  $globalpryamie = bd_nice_number($visitspryamie);



    if (preg_match('/тыс/',$globalzahodi,$matchs) || preg_match('/тыс/',$globalpryamie,$matchs)) {

      $globalzahodi = str_replace('.',' млн. ',$globalzahodi);

      $globalzahodi = $globalzahodi.'.';

      $globalpryamie = str_replace('.',' млн. ',$globalpryamie);

      $globalpryamie = $globalpryamie.'.';

    }





      if (!in_array($namesvod, $namesvodarr)) {



          if ($valuesvodka->name == 'Прямые заходы') {

           $cssclasstoblock = 'background-color: #7E57C2;';

          }

          if ($valuesvodka->name == 'Переходы из поисковых систем') {

           $cssclasstoblock = 'background-color: #536DFE;';

          }

          if ($valuesvodka->name == 'Переходы из социальных сетей') {

           $cssclasstoblock = 'background-color: #EF5350;';

          }

          if ($valuesvodka->name == 'Переходы по ссылкам на сайтах') {

           $cssclasstoblock = 'background-color: #EC407A;';

          }





            if ($CountYaBlocks == '5') {
              $gridmyrow = 'center myspan2 span2';
            }

            if ($CountYaBlocks == '4') {
              $gridmyrow = 'center myspan25 span2';
            }

            if ($CountYaBlocks == '3') {
            	$gridmyrow = 'center myspan3 span3';
            }

      echo '<div class="'.$gridmyrow.'  bigmonthdata " style="'.$cssclasstoblock.'">';

      echo ' <img src='.$iconc.' /> ';



      echo $pryamiezahodi;

      echo ' <img src="'.$icong.'" /> ';

      echo $visitspryamie;



      echo '<div class="nameotch">'.$namesvod = $valuesvodka->name.'</div>';

      echo '</div>';





    }



    // dump($valuesvodka,0,'Сводка');



  }



}







echo "<div class='clrboth'></div>";





if ($datapozapozavchera) {

//  dump($datapozapozavchera,0,'Сводка');

  // dump($datapozapozavchera,0,'poza');

  $datapozapozavcheradatedate = $datapozapozavchera->date1;

  $datapozapozavcheradatedate = date("d.m.Y", strtotime("+0 seconds", strtotime($datapozapozavcheradatedate)));

  $datapozapozavcheratotals = $datapozapozavchera->totals;

  $daytotalpv = $datapozapozavcheratotals->page_views;

  $daytotalvis = $datapozapozavcheratotals->visits;

  $datapozapozapozavcherat = $datapozapozapozavchera->totals;

  $datapozapozapv12 = $datapozapozapozavcherat->page_views;

  $datapozapozavis12 = $datapozapozapozavcherat->visits;





  $datapozapozavchera = $datapozapozavchera->data;

  // echo $daytotalpv;  echo " > ";  echo $datapozapozapv12 ;

  $checkdynamick = ($daytotalpv > $datapozapozapv12) ? '<img src='.$icond.' />' : '<img src='.$iconf.' />' ;



    if ($CountYaBlocks == '5') {
      $gridmyrow = 'center myspan2 span2';
    }

    if ($CountYaBlocks == '4') {
      $gridmyrow = 'center myspan25 span2';
    }

    if ($CountYaBlocks == '3') {
    	$gridmyrow = 'center myspan3 span3';
    }

      echo '<div class="'.$gridmyrow.'   bigmonthdata">';

    echo ' <img src='.$iconc.' /> ';

    echo $daytotalpv;

        echo ' <img src="'.$icong.'" /> ';



echo $daytotalvis;

if ($datapozavcheradatedate != $today_date) { echo $checkdynamick;  }



echo '<div class="nameotch">Посещаемость за: '.$datapozapozavcheradatedate.'</div>';



  echo '</div>';



  foreach ($datapozapozavchera as $key => $valuesvodka) {



    $namesvod =      $valuesvodka->name;



    $namesvodarr = array('Переходы с сохранённых страниц', 'Неопределён', 'Внутренние переходы');





  $pryamiezahodi = $valuesvodka->page_views;

  $visitspryamie = $valuesvodka->visits;



  $globalzahodi = bd_nice_number($pryamiezahodi);

  $globalpryamie = bd_nice_number($visitspryamie);



    if (preg_match('/тыс/',$globalzahodi,$matchs) || preg_match('/тыс/',$globalpryamie,$matchs)) {

      $globalzahodi = str_replace('.',' млн. ',$globalzahodi);

      $globalzahodi = $globalzahodi.'.';

      $globalpryamie = str_replace('.',' млн. ',$globalpryamie);

      $globalpryamie = $globalpryamie.'.';

    }





      if (!in_array($namesvod, $namesvodarr)) {





          if ($valuesvodka->name == 'Прямые заходы') {

           $cssclasstoblock = 'background-color: #7E57C2;';

          }

          if ($valuesvodka->name == 'Переходы из поисковых систем') {

           $cssclasstoblock = 'background-color: #536DFE;';

          }

          if ($valuesvodka->name == 'Переходы из социальных сетей') {

           $cssclasstoblock = 'background-color: #EF5350;';

          }

          if ($valuesvodka->name == 'Переходы по ссылкам на сайтах') {

           $cssclasstoblock = 'background-color: #EC407A;';

          }



            if ($CountYaBlocks == '5') {
              $gridmyrow = 'center myspan2 span2';
            }

            if ($CountYaBlocks == '4') {
              $gridmyrow = 'center myspan25 span2';
            }

            if ($CountYaBlocks == '3') {
            	$gridmyrow = 'center myspan3 span3';
            }

              echo '<div class="'.$gridmyrow.' bigmonthdata " style="'.$cssclasstoblock.'">';

      echo ' <img src='.$iconc.' /> ';



      echo $pryamiezahodi;

      echo ' <img src="'.$icong.'" /> ';

      echo $visitspryamie;



      echo '<div class="nameotch">'.$namesvod = $valuesvodka->name.'</div>';

      echo '</div>';





    }



    // dump($valuesvodka,0,'Сводка');



  }



}





// dump($datapozavchera,0,'$datapozavchera');

// dump($datavchera,0,'$datavchera');

// dump($datacurdate,0,'$datacurdate');



echo "<div class='clrboth'></div>";



 ?>



<?php

echo "<script src='//yastatic.net/es5-shims/0.0.2/es5-shims.min.js'></script> <script type='text/javascript' src='//yastatic.net/share2/share.js'></script>";

if (!empty($disqusApiShort)) {
	echo "<script id='dsq-count-scr' src='//{$disqusApiShort}.disqus.com/count.js' async></script>";
}


 ?>



<?php

if (!empty($datapopular->data)) {



echo "<hr>";

  echo "<p><b><big>Популярное по данным Я.Метрика:</big></b></p>";

  echo "<table id='myTable' class='zebratable'>";

  echo "<thead>";

 echo "<tr class='upper'>";

 echo "<td>ID </td>";

 // echo "<td>popentrance</td>";

 // echo "<td>popexit</td>";

 // echo "<td>popid</td>";

 echo "<td>Просмотры</td>";

 if (!empty($disqusApiShort)) { echo "<td>Disqus</td>"; }

 echo "<td>Адрес страницы</td>";

 echo "<td>Поделились</td>";

  echo "</tr>";

 echo "</thead>";

 echo "<tbody>";

 $countadd = '0';

    if ($datapopular) {



      $datapop = $datapopular->data;



        foreach ($datapop as $key => $valueobjarticle) {

            // $popentrance = $valueobjarticle->entrance;

            // $popexit  = $valueobjarticle->exit;

            // $popid  = $valueobjarticle->id;

            $poppage_views  = $valueobjarticle->page_views;

            $popurl  = $valueobjarticle->url;



        //    dump($valueobjarticle,0,'$valueobjarticle');

      if (preg_match($filterpopular, $popurl)) :

   $countadd++;

echo "<tr>";

echo "<td>{$countadd}</td>";

// echo "<td>{$popentrance}</td>";

// echo "<td>{$popexit}</td>";

// echo "<td>{$popid}</td>";

echo "<td>{$poppage_views}</td>";

if (!empty($disqusApiShort)) { echo "<td><span class='disqus-comment-count' data-disqus-url='{$popurl}'></span></td>"; }

echo "<td><a target='_blank' href='{$popurl}'>{$popurl}</a></td>";

echo "<td><div class='ya-share2' data-services='vkontakte,facebook,odnoklassniki,moimir,gplus' data-url='{$popurl}'  data-size='m' data-counter=''></div></td>";

echo "</tr>";

endif;

        }



    }

echo "</tbody>";

echo "</table>";


}

endif;

      if (empty($counter_id)) :
      echo "<h1 class='center'>Заполните API Яндекс.Метрика настройках компонента</h1>";
      endif;

 ?>



</div>
