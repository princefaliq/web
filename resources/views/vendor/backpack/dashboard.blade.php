@extends(backpack_view('blank'))

@php

    $widgets['after_content'][] = [
        'type'        => 'progress',
        'class'       => 'card text-white bg-danger mb-2',
        'value'       => '11.456',
        'description' => 'Registered users.',
        'progress'    => 57, // integer
        'hint'        => '8544 more until next milestone.',
        'wrapper' => [
                    'class' => 'col-sm-6 col-md-3', // customize the class on the parent element (wrapper)
                    'style' => 'border-radius: 10px;',
                    ]
    ];
    $widgets['before_content'][] = [
            'type'        => 'progress',
            'class'       => 'card text-white bg-success mb-2',
            'value'       => '80.412',
            'description' => 'Registered users.',
            'progress'    => 80, // integer
            'hint'        => '8544 more until next milestone.',
            'wrapper' => [
                    'class' => 'col-sm-6 col-md-3', // customize the class on the parent element (wrapper)
                    'style' => 'border-radius: 10px;',
                    ]
    ];
    $widgets['before_content'][] = [
            'type'        => 'progress',
            'class'       => 'card text-white bg-warning mb-2',
            'value'       => '15.000',
            'description' => 'Registered users.',
            'progress'    => 100, // integer
            'hint'        => '8544 more until next milestone.',
            'wrapper' => [
                    'class' => 'col-sm-6 col-md-3', // customize the class on the parent element (wrapper)
                    'style' => 'border-radius: 30px;',
                    ]
    ];
@endphp

@section('content')
    <hr />
@endsection
