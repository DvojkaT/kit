<ul class="nested">
@foreach($commentaries as $childCommentary)
        @if($childCommentary->commentaries->isNotEmpty())
            <li><span class="caret">{{$childCommentary->is_deleted ? $childCommentary->deletionReason() : $childCommentary->text}}</span>
                @include('orchid.treeActions', ['commentary' => $childCommentary])
                @include('orchid.childrenTree', ['commentaries' => $childCommentary->commentaries])
            </li>
        @else
            <li>- {{$childCommentary->is_deleted ? $childCommentary->deletionReason() : $childCommentary->text}}
            @include('orchid.treeActions', ['commentary' => $childCommentary])
            </li>
        @endif
@endforeach
</ul>

