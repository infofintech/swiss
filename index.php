<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Swiss Army Knife</title>
<link rel="shortcut icon" href="favicon.png?rev=<?=time();?>" type="image/x-icon">
<link href="swissknife.css?rev=<?=time();?>" rel="stylesheet">
<script src="jquery.js?rev=<?=time();?>"></script>
<script src="backend.js?rev=<?=time();?>"></script>
</head>
<body>
<p align='center'>
<a href="/"><img src="favicon.png?rev=<?=time();?>" style="width:18%;"></a>
</p>
<h1 align='center'>Swiss Army Knife</h1>
<p align='center'>
<input type="button" value="Get Package" style="width:82%" onclick="get(action.options[action.selectedIndex].id, host.value, pkg.value, repo.value, branch.value, user.value, false);"><br>
<input type="button" value="Get Repository" style="width:82%;" onclick="getdir(action.options[action.selectedIndex].id, host.value, pkg.value, repo.value, branch.value, user.value, false);">
</p>
<p align='center'>
<label>Action: </label><br>
<select id="action" style="width:82%;" onchange="
if (action.options[action.selectedIndex].id == 'i') {
    pkg.value = 'from';
    repo.value = '';
    branch.value = '';
    user.value = '';
} else if (action.options[action.selectedIndex].id == 'r') {
    pkg.value = '';
    repo.value = '';
    branch.value = '';
    user.value = '';
} else if (action.options[action.selectedIndex].id == 'd') {
    pkg.value = '';
    repo.value = 'from';
    branch.value = '';
    user.value = 'here';
}
">
<option id="i">Install</option>
<option id="r">Replace</option>
<option id="d">Remove</option>
</select><br>
<label>Host: </label><br>
<input type="text" id="host" style="width:82%;" value="https://github.com"><br>
<label>Package: </label><br>
<input type="text" id="pkg" style="width:82%;" value="from"><br>
<label>Repository: </label><br>
<input type="text" id="repo" style="width:82%;" value=""><br>
<label>Branch: </label><br>
<input type="text" id="branch" style="width:82%;" value=""><br>
<label>User: </label><br>
<input type="text" id="user" style="width:82%;" value=""><br>
</p>
</body>
</html>
