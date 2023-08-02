<a href="{{route('platform.systems.users.edit', ['user' => $commentary->user_id])}}" class="btn-success">Автор</a>
@if($user->hasAccess(config('orchid-permissions.platform-check.threads_commentaries.view')))
<a href="{{route('platform.threads.commentaries.edit', ['commentary' => $commentary])}}" class="btn-success">Редактировать</a>
@endif
