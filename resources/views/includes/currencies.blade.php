@php($currencies = App\Services\Currencies\Models\Currency::getCached())

<li class="nav-item dropdown">
    <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
        {{ currency() }}
    </a>
    <ul class="dropdown-menu">
        @foreach($currencies as $currency)
            <li>
                <form method="post" action="{{ route('currency', $currency) }}">
                    @csrf
                    <button type="submit" style="background: none; border: none; width: 100%; text-align: left; cursor: pointer;">
                        {{ $currency->id }}
                    </button>
                </form>
            </li>
        @endforeach
    </ul>
</li>
