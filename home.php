<html>
    <head>
        <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script>
        function getText(){
           window.location.href="apiprocessor.php?title="+document.getElementById("title").value;
        }
    </script>
    </head>
    <body>
        <center><h2 class="text-center"><b>WikiSource Page Test</b></h2></center>
        <div class="container">
            <div class="row">
                <div class="card">
                    <div class="col-md-12 card-body" style="background:#294584">
                        <div class="form-group">
                            <label class="text-white">Text Title:. </label>
                            <input class="form-control" id="title" placeholder="Type the Title Of The Text">
                            <button class="btn btn-primary mt-3" onclick="getText()">Get File</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="responseShow"></div>
            </div>
        </div>
    </body>
</html>