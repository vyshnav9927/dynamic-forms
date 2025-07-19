<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Form Created</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .form-details {
            background-color: white;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #4CAF50;
        }

        .field-list {
            margin: 10px 0;
        }

        .field-item {
            background-color: #f0f0f0;
            padding: 8px;
            margin: 5px 0;
            border-radius: 3px;
        }

        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>🎉 New Form Created!</h1>
    </div>

    <div class="content">
        <p>Hello {{ $form->user->name }},</p>

        <p>A new form has been successfully created in your form generator system.</p>

        <div class="form-details">
            <h3>Form Details:</h3>
            <p><strong>Form Name:</strong> {{ $form->form_name }}</p>
            <p><strong>Form ID:</strong> #{{ $form->id }}</p>
            <p><strong>Created At:</strong> {{ $form->created_at->format('M d, Y at h:i A') }}</p>
            <p><strong>Created By:</strong> {{ $form->user->name }}</p>
        </div>

        @if ($form->formFields && $form->formFields->count() > 0)
            <div class="field-list">
                <h4>Form Fields ({{ $form->formFields->count() }} fields):</h4>
                @foreach ($form->formFields as $field)
                    <div class="field-item">
                        <strong>{{ $field->field_label }}</strong> - {{ ucfirst($field->field_type) }}
                        @if ($field->field_options)
                            <br><small>Options:
                                {{ implode(', ', unserialize($field->field_options)) }}</small>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        <p>This form is now ready to collect responses from users.</p>

    </div>

</body>

</html>
