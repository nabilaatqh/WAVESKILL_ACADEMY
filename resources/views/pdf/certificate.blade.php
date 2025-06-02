<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('{{ $templatePath }}');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Arial', sans-serif;
            color: #000;
            position: relative;
        }

        .name-area {
            position: absolute;
            top: 40%;
            width: 100%;
            text-align: center;
            font-size: 32px;
            font-weight: bold;
        }

        .course-area {
            position: absolute;
            top: 48%;
            width: 100%;
            text-align: center;
            font-size: 18px;
            font-weight: normal;
        }

        .signature-area {
            position: absolute;
            bottom: 110px;
            width: 100%;
            padding: 0 80px;
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }

        .signature-name {
            border-top: 1px solid #000;
            padding-top: 5px;
            text-align: center;
        }

        .signature-title {
            font-style: italic;
            margin-top: 2px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="name-area">
        {{ $studentName }}
    </div>

    <div class="course-area">
        has successfully completed the <strong>{{ $courseName }}</strong> course
    </div>

    <div class="signature-area">
        <div>
            <div class="signature-name">{{ $instrukturName }}</div>
            <div class="signature-title">Instructor</div>
        </div>
        <div>
            <div class="signature-name">Nabila Dong Apanya</div>
            <div class="signature-title">Co-Founder WaveSkill Academy</div>
        </div>
    </div>
</body>
</html>