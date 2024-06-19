<!DOCTYPE html>
<html lang="en">
	
	<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>UBold - Responsive Bootstrap 4 Admin Dashboard</title>
		 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		
	</head>
	
	<body style="background-color: #fff;">
		<style>
			@font-face {
					font-family: ipag;
					font-style: normal;
					font-weight: normal;
					src: url("' . $fonturl . '");
				} 
				body {
					font-family: "ipag", "Open Sans", !important;
					}
				
				table {
					border-collapse: collapse;
					width: 100%;
					line-height: 20px;
					letter-spacing: 0.0133em;
					}
					
					td,
					th {
					border: 1px solid black;
					text-align: center;
					line-height: 20px;
					letter-spacing: 0.0133em;
					word-wrap: break-word;
					}
				
				.line {
				height: 10px;
				right: 10px;
				margin: auto;
				left: -5px;
				width: 100%;
				border-top: 1px solid #000;
				-webkit-transform: rotate(14deg);
				-ms-transform: rotate(14deg);
				transform: rotate(14deg);
				}
				
				.diagonal {
				width: 150px;
				height: 40px;
				}
				
				.diagonal span.lb {
				bottom: 2px;
				left: 2px;
				}
				.table th, .table td {
					border: none; /* Removes borders from table headers and cells */
					padding: 8px; /* Adds padding for better readability */
					text-align: left; /* Aligns text to the left */
				}
				
				.diagonal span.rt {
				top: 2px;
				right: 2px;
				}
				.diagonalCross2 {
				background: linear-gradient(to top right, #fff calc(50% - 1px), black , #fff calc(50% + 1px) )
				}
			
			
			
			
		</style>
		
		
		<table class="table" width="100%" border=0>		
			
            <tr>
                <td >
					<h4>X Grade</h4>
				</td>
				<td>
					<h4>1 Semester</h4>
				</td>
				<td>
					<h4>Test </h4>
				</td>
				<td >クラス :</td>
				<td >番 : </td>
			</tr>
			
			<tr style="height:60px;">
				<th colspan="2" >ロール番号 : 1</th>
				<th colspan="3" >名前 : 広瀬 すず</th>
			</tr>
			<tr style="">
			<td colspan="5" >
				<table  width="100%" border=1>
					<thead>
						<tr>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;">Language</td>
							<td style=" border: 1px solid #959595;">Society</td>
							<td style=" border: 1px solid #959595;">Math</td>
							<td style=" border: 1px solid #959595;">Science</td>
							<td style=" border: 1px solid #959595;">English</td>
							<td style=" border: 1px solid #959595;">Music</td>
							<td style=" border: 1px solid #959595;">Art</td>
							<td style=" border: 1px solid #959595;">Sport</td>
							<td style=" border: 1px solid #959595;">Home <br>Economics</td>
							<td style=" border: 1px solid #959595;">5教科合計</td>
							<td style=" border: 1px solid #959595;">9教科合計</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style=" border: 1px solid #959595;">個人得点</td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
						</tr>
						<tr>
							<td style=" border: 1px solid #959595;">学年平均</td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
							<td style=" border: 1px solid #959595;"></td>
						</tr>
					</tbody>
				</table>
				<br>
				<table class="main" width="100%">
					<thead>
						<tr style="height:60px;">
							<td style=" border: 1px solid #959595;">できたこと・よかったこと </td>
							<td style=" border: 1px solid #959595;">できなかったこと・反省，今後の学習に向けて</td>
							<td style=" border: 1px solid #959595;">保護者の方のコメント</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style=" border: 1px solid #959595;height:200px;"></td>
							<td style=" border: 1px solid #959595;height:200px;"></td>
							<td style=" border: 1px solid #959595;height:200px;"></td>
						</tr>
					</tbody>
				</table>
			</tr>
		</table>
		<div class="row">
         <div class="col-md-6"><canvas  id="myChart1" ></canvas></div>
		<div class="col-md-6"><canvas  id="myChart2" ></canvas></div>
    </div>
    <script>
        $(document).ready(function() {
            // Initial data for the Tamil chart
            var subjectDataTamil = {
                labels: ["100-90", "89-80", "79-70", "69-60", "59-50", "49-40", "39-30", "29-20", "19-10", "9-0"],
                datasets: [{
                    label: 'Tamil',
                    data: [36, 55, 30, 60, 70, 48, 27, 14, 12, 3],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            };

            // Initial data for the English chart
            var subjectDataEnglish = {
                labels: ["100-90", "89-80", "79-70", "69-60", "59-50", "49-40", "39-30", "29-20", "19-10", "9-0"],
                datasets: [{
                    label: 'English',
                    data: [36, 55, 30, 60, 70, 48, 27, 14, 12, 3],
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            };

            // Configuration options for the Tamil chart
            var configTamil = {
                type: 'bar',
                data: subjectDataTamil,
                options: {
                    indexAxis: 'y', // Horizontal bar chart
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            };

            // Configuration options for the English chart
            var configEnglish = {
                type: 'bar',
                data: subjectDataEnglish,
                options: {
                    indexAxis: 'y', // Horizontal bar chart
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            };

            // Create the Tamil chart
            var myChartTamil = new Chart(
                document.getElementById('myChart1'),
                configTamil
            );

            // Create the English chart
            var myChartEnglish = new Chart(
                document.getElementById('myChart2'),
                configEnglish
            );
        });
    </script>
	</body>
	
</html>		