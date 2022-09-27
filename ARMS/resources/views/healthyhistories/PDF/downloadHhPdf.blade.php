<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            table{
                width: 100%;
                /* margin-top: 8rem; */
            }

            table, th, td{
                border-bottom: solid rgba(0, 0, 0, 0.3) 1px;
                text-align: left;
                border-collapse: collapse;
            }
            
            td{
                font-size: 0.65rem
            }

            th{
                font-size: 0.75rem
            }

            header{
                position: relative;
                width: 100%;
                padding: 0;
                height: auto;
            }
            
            header .right{
                position: absolute;
                padding: 0;
                margin: 0;
                right: 0px;
                font-size: 0.75rem;
                width: auto;
                height: auto;
            }

            header .logo{
                position: absolute;
                padding: 0;
                margin: 0;
                left: 0px;
                width: auto;
                height: auto;

            }

            header .right h3{
                padding: 0; 
                margin: 0;
            }

            header .right ul{
                padding: 0; 
                margin: 0;
                list-style: none;
            }
            
            .heading{
                text-align: center;
                /* text-transform: uppercase; */
                text-transform:capitalize;
                text-decoration: underline;
                font-style: italic;
                margin-top: 6rem;
                font-size: 0.8rem;
                font-weight:bold;
            }

            .emptyRecord{
                color: rgba(255, 0, 0, 0.8);
                font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
                font-size: 0.8rem;
            }

            footer{
                margin-top: 1rem;
                display:flex;
                position: relative;
                font-style: italic
            }
            footer div{
                position: absolute;
                padding: 0;
                margin: 0;
                font-size: 0.6rem;
                left: 0px;
            }
            footer p{
                position: absolute;
                padding: 0;
                margin: 0;
                font-size: 0.55rem;
                right: 0px;
            }
        </style>
    </head>
    <body>
        <header>
            <div class="logo">
                <img src="./img/cow_cattle_farm_262786.jpg" width="100" height="95" style="border-radius: 4rem 4rem 4rem 4rem">
            </div>
            <div class="right">
            <h3><i>CompanyNamewie;qoiv;fvjlkjglgk</i></h3>
            <ul>
                <li><b>Location:<i></i></b></li>
                <li><b>Office Contact:<i></i></b></li>
                <li><b>Mobile:<i></i></b></li>
                <li><b>E-mail:<i></i></b></li>
                <li><b>Date:<i><?php echo ' '.date('d/m/Y', strtotime(now())) ?></i></b></li>
            </ul>
            </div>
        </header>
        <div class="heading">
            Healthy History for all animals in the Healthy registry.
        </div>
        <table class="table">
            <tr class="trh">
                <th>Date</th>
                <th>Tag No.</th>
                <th>Vetinary Doctor</th>
                <th>Daignosis</th>
                <th>Treatment</th>
                <th>Recommendation</th>
            </tr>
            @forelse ($toDownloadPdfHealthyhistories as $healthyhistory)
                <tr>
                    <td>
                        {{ date('d/m/Y', strtotime($healthyhistory->created_at)) }}
                    </td>
                    <td>
                        <b><u>{{ date('Ymd', strtotime($healthyhistory->animal->DoJ)).'-'.$healthyhistory->animal->id }}
                    </td>
                    <td>
                        {{ $healthyhistory->vetdoctor->Names }}
                    </td>
                    <td>
                        {{ $healthyhistory->Daignosis }}
                    </td>
                    <td>
                        {{ $healthyhistory->Treatment }}
                    </td>
                    <td>
                        {{ $healthyhistory->Recommendation }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <p>No Record found in the Database!!</p>
                    </td>
                </tr>
            @endforelse
        </table>
        <footer>
            <div>Healthy History for all animals in the Healthy registry.</div>
            <p>{{ date('d/m/Y', strtotime(now())) }}</p>
        </footer>
    </body>
</html>