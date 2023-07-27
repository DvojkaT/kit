<h3>Комментарии</h3>
<div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
@foreach($thread->commentaries as $commentary)
    <ul id="treeUL">
        @if($commentary->commentaries->isNotEmpty())
            <li><span class="caret">{{$commentary->is_deleted ? $commentary->deletionReason() : $commentary->text}}</span>
                @include('orchid.treeActions', $commentary)
                @include('orchid.childrenTree', ['commentaries' => $commentary->commentaries])
            </li>
        @else
            <li>- {{$commentary->is_deleted ? $commentary->deletionReason() : $commentary->text}}
            @include('orchid.treeActions', $commentary)
            </li>
        @endif
    </ul>
@endforeach
</div>
