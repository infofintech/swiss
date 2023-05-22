<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Swiss Army Knife</title>
<link rel="shortcut icon" href="swiss.icon.png?rev=<?=time();?>" type="image/x-icon">
<style>
@font-face {
    font-family: "wenger";
    src: url("wenger.ttf?rev=<?=time();?>");
}
body {
    background-size: cover;
    background-color: #C31B37;
    font-family: "wenger";
}
p, a, b, i {
    font-family: "wenger";
    color: #FFFFFF;
}
</style>
<script src="minijquery.js?rev=<?=time();?>"></script>
<script src="miniback.js?rev=<?=time();?>"></script>
</head>
<body>
<p align='center'>
<img src="swiss.icon.png?rev=<?=time();?>" style="width:12%;">
</p>
<p align='center'>
<input type="button" value="Get Package" onclick="minipkg(action.options[action.selectedIndex].id, host.value, pkg.value, repo.value, branch.value, user.value, false);"><br>
<input type="button" value="Get Repository" onclick="minirepo(action.options[action.selectedIndex].id, host.value, pkg.value, repo.value, branch.value, user.value, false);">
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
