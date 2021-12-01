<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>SacsiN | Seller</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/sacsin-admin-style.css">

    <!-- Font Awesome JS -->
    <script defer src="../assets/fontawesome-free-5.15.3-web/js/all.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="sidebar-seller">
            <div class="sidebar-header">
                <h3 hidden>SacsiN Sidebar</h3>
                <img src="../assets/img/logo/sacsin_logo_dark.png" alt="" width="125">
            </div>

            <ul class="list-unstyled components pt-3">
                <h3 class="ml-4 mb-4 text-uppercase">Seller</h3>
                <li>
                    <a href="#">
                        <span class="mx-3"><i class="fas fa-chart-pie"></i></span> Overview
                    </a>
                </li>
                <li class="active">
                    <a href="#requests" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                        <span class="mx-3"><i class="fas fa-comments"></i></span> Requests
                    </a>
                    <ul class="collapse list-unstyled show" id="requests" style="padding-left: 2.5rem;">
                        <!-- <li>
                            <a href="./"><i class="fa fa-upload mr-2"></i> Import Request</a>
                        </li> -->
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span class="mx-3"><i class="fas fa-cogs"></i></span> Settings
                    </a>
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
                        <span class="mr-1 username">Mary Li</span>
                        <img src="../assets/img/pp_default.jpg" alt="pp" style="border-radius: 50%;" width="35px">
                    </div>

                </div>
            </nav>

            <div class="p-5 pt-4">

                <h2 class="mb-5" style="color: transparent;">
                    .
                    
                    <span class="float-right">
                        <form><input type="file" name="import-file" hidden></form>
                        <button class="btn btn-primary px-5 py-2 mt-1 ml-1" id="import-file">
                            <i class="fas fa-file-upload mr-2"></i> 
                            Import Request
                        </button>
                    </span>
                </h2>

                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr class="border-0 text-center">
                                        <th scope="col" id="all" class="text-primary">All <span class="text-details">(0)</span></th>
                                        <th scope="col" id="completed">Completed Request <span class="text-details">(0)</span></th>
                                        <th scope="col" id="pending">Pending Request <span class="text-details">(0)</span></th>
                                        <th scope="col" id="sub">Sub Request <span class="text-details">(0)</span></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover my-2" id="requests-table">
                                <thead class="requests">
                                    <!-- table row(s) injected here -->
                                </thead>
                                <tbody class="requests">
                                    <!-- table row(s) injected here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">

        // import the request package.
        $(document).ready(function($) {
            $('#import-file').on('click', function () {
                $('[name="import-file"]').click()
                $('[name="import-file"]').on('change', function () {
                    let _file = $('[name="import-file"]').prop('files')[0]
                    // console.log(_file)
                    // let a = _file.name.split('.')
                    // console.log(a[a.length-1])
                    let _data = new FormData()
                    _data.append('file', _file)
                    $.ajax({
                        url: '../assets/php/ImportRequest.php',
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: _data,                         
                        method: 'POST',
                        success: function(res_data){
                            console.log(res_data)
                            fetchRequestPackages() // fetch objects
                        }
                    })
                })
            })


            fetchRequestPackages() // fetch objects
            function fetchRequestPackages() {
                $.ajax({
                    dataType: 'json',
                    url: '../assets/php/ReadRequestPackages.php',
                    success: (res_data) => {
                        console.log(res_data)
                        let table_rows = ""
                        res_data.forEach(data => {
                            // console.log(data.display)
                            if (data.display == "1") {
                                let status_class = (data.status.toLowerCase() === "pending") ? "alert alert-danger" : "alert alert-success"
                                table_rows += `
                                    <tr onclick="location.href='requests_2?r_id=${data.request_id}'">
                                        <td>${data.request_id}</td>
                                        <td class="text-primary">${data.product}</td>
                                        <td>${data.buyer}</td>
                                        <td class="${data.status}">
                                            <button class="${status_class}" role="alert" style="border-radius: 25px;">
                                                ${data.status}
                                            </button>
                                        </td>
                                        <td>${data.last_edited}</td>
                                    </tr>`
                            } 
                            if (table_rows === "") {
                                table_rows = `
                                    <div>
                                        <i class="fas fa-frown-open fa-8x" color="lightgrey"></i>
                                        <p class="text-center">You have no requests</p>
                                    </div>`
                            }
                        })
                        // inect data to table head
                        let tr = `<tr>
                                        <th scope="col">Rquest ID</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Requestor</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Last Edited</th>
                                    </tr>`
                        $('thead.requests').html(tr)
                        // Inject data to table body
                        $('tbody.requests').html(table_rows)
                        // indicator
                        $('th#all>span.text-details').html(`(${$('#requests-table>tbody>tr').length})`)
                        $('th#completed>span.text-details').html(`(${$('#requests-table>tbody>tr>td.Completed').length})`)
                        $('th#pending>span.text-details').html(`(${$('#requests-table>tbody>tr>td.Pending').length})`)
                    },
                    error: (res) => {
                        console.log(res)
                    }
                })
            }
        })



        $(document).ready(() => {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('current')
            })
        });

        // const is_prime = num => {
        //     for(let i = 2, s = Math.sqrt(num); i <= s; i++)
        //         if(num % i === 0) return false; 
        //     return num > 1;
        // }
    </script>

</html>