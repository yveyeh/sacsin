<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>SacsiN | Buyer</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/sacsin-admin-style.css">
    <link rel="stylesheet" href="../assets/css/sacsin-scrollbar-style.css">

    <!-- Font Awesome JS -->
    <script defer src="../assets/fontawesome-free-5.15.3-web/js/all.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3 hidden>SacsiN Sidebar</h3>
                <img src="../assets/img/logo/sacsin_logo_dark.png" alt="" width="100">
            </div>

            <ul class="list-unstyled components">
                <h3 class="ml-4 mb-4 text-uppercase">Buyer</h3>
                <li>
                    <a href="#"><span class="mx-3"><i class="fas fa-chart-pie"></i></span> Overview</a>
                </li>
                <li class="active">
                    <a href="#requestPackage" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                        <span class="mx-3"><i class="fas fa-box"></i></span> Request Package
                    </a>
                    <ul class="collapse list-unstyled show" id="requestPackage">
                        <li class="current">
                            <a href="./">
                                Request Packages
                            </a>
                        </li>
                        <li>
                            <a href="create-request">Create Request</a>
                        </li>
                        <li>
                            <a href="object">Request Package Template</a>
                        </li>
                        <li>
                            <a href="request-sentence">Request Sentence</a>
                        </li>
                        <li>
                            <a href="expected-response">Expected Response</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><span class="mx-3"><i class="fas fa-comments"></i></span> Settings</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                    </button>

                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control" placeholder="Search">
                    </div>

                    <div class="profile">
                        <span class="mr-4 notification"><i class="fa fa-bell"></i></span>
                        <span class="mr-1 username">James Green</span>
                        <img src="../assets/img/pp_default.jpg" alt="pp" style="border-radius: 50%;" width="35px">
                    </div>

                </div>
            </nav>

            <div class="p-5 pt-4">

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h4 class="card-title">
                            Product Request Package Relation
                            <span class="card-actions">
                                <span><i class="fa fa-download"></i></span>
                                <span><i class="fa fa-trash"></i></span>
                                <span><i class="fa fa-search"></i></span>
                                <span><button class="btn btn-primary-light" onclick="location.href='create-request'">New</button></span>
                            </span>
                        </h4>
                        <div class="table-responsive mt-5">
                            <table class="table table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th scope="row">
                                            <input type="checkbox" name="">
                                        </th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Seller</th>
                                        <th scope="col">Objects</th>
                                        <th scope="col">Last Edited</th>
                                    </tr>
                                </thead>
                                <tbody class="objects">
                                    <!-- Inject table data dynamically here-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>


    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- Custom Script -->
    <script src="../assets/js/sacsin-admin-script.js"></script>

    <script>
        $(document).ready(function($) {

            // var file = new File(["foo"], "foo.txt", {
            //     type: "text/plain",
            // });

            fetchRequestPackages() // fetch objects

            function fetchRequestPackages() {
                $.ajax({
                    dataType: 'json',
                    url: '../assets/php/ReadRequestPackages.php',
                    headers: { 'Content-Disposition': 'attachment; filename="downloaded.scsn"' },
                    success: (res_data) => {
                        console.log(res_data)
                        let table_rows = ""
                        res_data.forEach(data => {
                            table_rows += `
                                <tr>
                                    <th scope="row">
                                        <input type="checkbox" name="">
                                    </th>
                                    <td>${data.product}</td>
                                    <td>${data.seller}</td>
                                    <td>${getObjNames(data.objects)}</td>
                                    <td>${data.last_edited}</td>
                                    <td>
                                        <a href="../assets/php/exports/${data.exp_file}" download>
                                            <i class="fa fa-download" title="export request package"></i>
                                        </a>
                                    </td>
                                </tr>`
                        })
                        // Inject data to table
                        $('tbody.objects').html(table_rows)
                    },
                    error: (res) => {
                        console.log(res)
                    }
                })
            }

            function getObjNames(objs) {
                let table_data = ""
                objs.forEach(obj => {
                    table_data += `<button class="alert alert-success mr-2" role="alert" style="border-radius: 25px;">
                                                ${obj}
                                            </button>`
                })
                console.log(table_data)
                return table_data
            }

        })
    </script>

</body>

</html>