<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Personal Information</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f8;
            color: #222;
        }

        .page {
            min-height: 100vh;
            padding: 50px 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .header {
            padding: 30px 40px;
            border-bottom: 1px solid #e5e7eb;
        }

        .header h1 {
            margin: 0 0 8px;
            font-size: 28px;
            font-weight: 700;
        }

        .header p {
            margin: 0;
            color: #6b7280;
            font-size: 15px;
        }

        .form-container {
            padding: 35px 40px 40px;
        }

        .section-title {
            margin: 0 0 25px;
            font-size: 19px;
            font-weight: 600;
            color: #111827;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
            background: white;
            color: #111827;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        input[readonly] {
            background: #f9fafb;
            color: #6b7280;
        }

        .divider {
            margin: 38px 0 30px;
            border: 0;
            border-top: 1px solid #e5e7eb;
        }

        .parent-title {
            margin-bottom: 25px;
        }

        .button-area {
            display: flex;
            justify-content: flex-end;
            margin-top: 35px;
        }

        .save-button {
            border: none;
            border-radius: 8px;
            padding: 13px 24px;
            background: #4f46e5;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .save-button:hover {
            background: #4338ca;
        }

        @media (max-width: 700px) {
            .page {
                padding: 20px 12px;
            }

            .header,
            .form-container {
                padding: 25px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .button-area {
                justify-content: stretch;
            }

            .save-button {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <div class="container">

        <!-- Header -->
        <div class="header">
            <h1>👤 Personal Information</h1>
            <p>Manage your personal information</p>
        </div>

        <!-- Form -->
        <div class="form-container">

            <form method="POST" action="{{ route('profile.store') }}">

                @csrf

                <!-- Personal Information -->
                <h2 class="section-title">Personal Information</h2>

                <div class="form-grid">

                    <!-- Full Name -->
                    <div class="form-group">
                        <label for="full_name">Full Name</label>

                        <input
                            type="text"
                            id="full_name"
                            name="full_name"
                            value="{{ old('full_name', $profile->full_name ?? auth()->user()->name) }}"
                            placeholder="Enter your full name"
                        >
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>

                        <input
                            type="email"
                            id="email"
                            value="{{ auth()->user()->email }}"
                            readonly
                        >
                    </div>

                    <!-- Phone -->
                    <div class="form-group">
                        <label for="phone">Phone</label>

                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone', $profile->phone ?? '') }}"
                            placeholder="01XXXXXXXXX"
                        >
                    </div>

                    <!-- Date of Birth -->
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>

                        <input
                            type="date"
                            id="date_of_birth"
                            name="date_of_birth"
                            value="{{ old('date_of_birth', isset($profile->date_of_birth) ? $profile->date_of_birth->format('Y-m-d') : '') }}"
                        >
                    </div>

                    <!-- Gender -->
                    <div class="form-group">
                        <label for="gender">Gender</label>

                        <select id="gender" name="gender">
                            <option value="">Select Gender</option>

                            <option value="Female"
                                {{ old('gender', $profile->gender ?? '') == 'Female' ? 'selected' : '' }}>
                                Female
                            </option>

                            <option value="Male"
                                {{ old('gender', $profile->gender ?? '') == 'Male' ? 'selected' : '' }}>
                                Male
                            </option>

                            <option value="Other"
                                {{ old('gender', $profile->gender ?? '') == 'Other' ? 'selected' : '' }}>
                                Other
                            </option>
                        </select>
                    </div>

                    <!-- Country -->
                    <div class="form-group">
                        <label for="country">Country</label>

                        <input
                            type="text"
                            id="country"
                            name="country"
                            value="{{ old('country', $profile->country ?? 'Bangladesh') }}"
                            placeholder="Enter your country"
                        >
                    </div>

                    <!-- Address -->
                    <div class="form-group full">
                        <label for="address">Address</label>

                        <textarea
                            id="address"
                            name="address"
                            placeholder="Enter your full address"
                        >{{ old('address', $profile->address ?? '') }}</textarea>
                    </div>

                    <!-- City -->
                    <div class="form-group">
                        <label for="city">City</label>

                        <input
                            type="text"
                            id="city"
                            name="city"
                            value="{{ old('city', $profile->city ?? '') }}"
                            placeholder="Enter your city"
                        >
                    </div>

                </div>

                <!-- Parent Information -->
                <hr class="divider">

                <h2 class="section-title parent-title">
                    Parent Information
                </h2>

                <div class="form-grid">

                    <!-- Parent 1 Name -->
                    <div class="form-group">
                        <label for="parent1_name">Parent 1 Name</label>

                        <input
                            type="text"
                            id="parent1_name"
                            name="parent1_name"
                            value="{{ old('parent1_name', $profile->parent1_name ?? '') }}"
                            placeholder="Enter parent's name"
                        >
                    </div>

                    <!-- Parent 1 Phone -->
                    <div class="form-group">
                        <label for="parent1_phone">Parent 1 Phone</label>

                        <input
                            type="text"
                            id="parent1_phone"
                            name="parent1_phone"
                            value="{{ old('parent1_phone', $profile->parent1_phone ?? '') }}"
                            placeholder="01XXXXXXXXX"
                        >
                    </div>

                    <!-- Parent 2 Name -->
                    <div class="form-group">
                        <label for="parent2_name">Parent 2 Name</label>

                        <input
                            type="text"
                            id="parent2_name"
                            name="parent2_name"
                            value="{{ old('parent2_name', $profile->parent2_name ?? '') }}"
                            placeholder="Enter parent's name"
                        >
                    </div>

                    <!-- Parent 2 Phone -->
                    <div class="form-group">
                        <label for="parent2_phone">Parent 2 Phone</label>

                        <input
                            type="text"
                            id="parent2_phone"
                            name="parent2_phone"
                            value="{{ old('parent2_phone', $profile->parent2_phone ?? '') }}"
                            placeholder="01XXXXXXXXX"
                        >
                    </div>

                </div>

                <!-- Save Button -->
                <div class="button-area">
                    <button type="submit" class="save-button">
                        💾 Save Information
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>