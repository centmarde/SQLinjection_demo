<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Injection Demo</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        #response {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <br><br><br><br>
        <div class="row">
            <div class="col-8">
                <div class="text-light" id="response"></div>
            </div>
            <div class="col-4">
                <div class="card shadow-lg" style="width: 26rem;">
                    <div class="card-body">
                        <h5 class="text-center">SQL Injection DEMO</h5>
                        <h2 class="text-center">Login</h2>
                        <form id="loginForm" action="login.php" method="POST">
                            <div class="form-group mt-3">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                            </div>
                            <div class="d-flex"> <button type="submit" class="btn btn-primary btn-block mt-3">Login</button>
                            <button type="button" class="ms-3 btn btn-primary btn-block mt-3" onclick="location.reload();">Reset</button>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'login.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    var responseElement = document.getElementById('response');

                    if (response.status === 'success') {
                        var html = '<h1>' + response.message + '</h1>';
                        if (response.users) {
                            html += '<h2>All Users:</h2>';
                            html += '<table class="table table-bordered"><thead><tr><th>ID</th><th>Username</th><th>Password</th></tr></thead><tbody>';
                            response.users.forEach(function(user) {
                                html += '<tr><td>' + user.id + '</td><td>' + user.username + '</td><td>' + user.password + '</td></tr>';
                            });
                            html += '</tbody></table>';
                        }
                        responseElement.innerHTML = html;
                    } else {
                        responseElement.innerHTML = '<h1>' + response.message + '</h1>';
                    }
                }
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>
