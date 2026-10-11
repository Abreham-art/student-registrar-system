<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Registrar System</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #172554;
            color: white;
            padding: 25px 15px;
        }

        .logo {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 35px;
        }

        .logo span {
            display: block;
            font-size: 12px;
            font-weight: normal;
            margin-top: 5px;
            color: #bfdbfe;
        }

        .menu a {
            display: block;
            padding: 13px 15px;
            margin-bottom: 5px;
            border-radius: 7px;
            color: #e0e7ff;
            text-decoration: none;
        }

        .menu a:hover,
        .menu .active {
            background: #2563eb;
            color: white;
        }

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            height: 70px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            border-bottom: 1px solid #e5e7eb;
        }

        .topbar h2 {
            font-size: 20px;
        }

        .user {
            font-size: 14px;
            color: #4b5563;
        }

        .content {
            padding: 30px;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome h1 {
            font-size: 28px;
            margin-bottom: 7px;
        }

        .welcome p {
            color: #6b7280;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
        }

        .card-title {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .card-number {
            font-size: 30px;
            font-weight: bold;
        }

        .section {
            background: white;
            margin-top: 25px;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
        }

        .section h3 {
            margin-bottom: 15px;
        }

        .logout {
            margin-top: 25px;
        }

        .logout button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 7px;
            background: #dc2626;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }

        @media (max-width: 900px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                width: 200px;
            }

            .main {
                margin-left: 200px;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">

        <div class="logo">
            🎓 REGISTRAR
            <span>Management System</span>
        </div>

        <nav class="menu">

            <a href="/dashboard" class="active">
                🏠 Dashboard
            </a>

            <a href="#">
                👨‍🎓 Students
            </a>

            <a href="#">
                🏫 Departments
            </a>

            <a href="#">
                🎓 Programs
            </a>

            <a href="#">
                📚 Courses
            </a>

            <a href="#">
                📅 Academic Years
            </a>

            <a href="#">
                📝 Registration
            </a>

            <a href="#">
                📊 Grades
            </a>

            <a href="#">
                📜 Transcript
            </a>

            <a href="#">
                🎓 Graduation
            </a>

            <a href="#">
                📈 Reports
            </a>

        </nav>

        <div class="logout">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit">
                    🚪 Logout
                </button>
            </form>

        </div>

    </aside>


    <main class="main">

        <header class="topbar">

            <h2>Dashboard</h2>

            <div class="user">
                👤 {{ auth()->user()->name }}
            </div>

        </header>


        <section class="content">

            <div class="welcome">

                <h1>Welcome, {{ auth()->user()->name }} 👋</h1>

                <p>
                    Welcome to the Registrar Management System.
                </p>

            </div>


            <div class="cards">

                <div class="card">
                    <div class="card-title">
                        Total Students
                    </div>

                    <div class="card-number">
                        0
                    </div>
                </div>


                <div class="card">
                    <div class="card-title">
                        Departments
                    </div>

                    <div class="card-number">
                        0
                    </div>
                </div>


                <div class="card">
                    <div class="card-title">
                        Programs
                    </div>

                    <div class="card-number">
                        0
                    </div>
                </div>


                <div class="card">
                    <div class="card-title">
                        Courses
                    </div>

                    <div class="card-number">
                        0
                    </div>
                </div>

            </div>


            <div class="section">

                <h3>Recent Registrations</h3>

                <p>
                    No student registrations yet.
                </p>

            </div>

        </section>

    </main>

</body>
</html>