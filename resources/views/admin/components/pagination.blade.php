
<ul class="pagination pagination my-2" style="justify-content:center;">
    @php
        $i = $page > 1 ? $page - 1 : $page;
        // $i = $page < $maxPage ? $page - 2 : $i;
        $max = $i + 2 > $maxPage ? $maxPage : $i + 2;
    @endphp

    @if ($page > 1)
        <li class="page-item"><button class="page-link" name="page"
                value="{{ $page - 1 }}">&laquo;</button></li>
    @endif

    @while ($i <= $max)
        <li class="page-item @if ($page == $i) active @endif"><button class="page-link" name="page"
                value="{{ $i }}">{{ $i }}</button></li>
        @php
            $i++;
        @endphp
    @endwhile
    @if ($page < $maxPage)
        <li class="page-item"><button class="page-link" name="page"
                value="{{ $page + 1 }}">&raquo;</button></li>
    @endif
</ul>
