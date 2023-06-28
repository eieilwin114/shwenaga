<div class="nav-item dropstart">
  <a class="dropdown-toggle btn" href="#navbar-third" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
    အလင်းအမှောင်
    <i class="ti ti-moon ms-3"></i> 
  </a>
  <form action="{{ route('themes.update') }}" method="POST" class="dropdown-menu dropdown-end">
    @csrf
    @method('PUT')
    <button class="dropdown-item" value="light" type="submit" name="theme">
      <i class="ti ti-moon me-3"></i>
      အလင်း
    </button>
    <button class="dropdown-item" value="dark" type="submit" name="theme">
      <i class="ti ti-moon me-3"></i>
      အမှောင်
    </button>
    <button class="dropdown-item" value="auto" type="submit" name="theme">
      <i class="ti ti-moon-2 me-3"></i>
      စက်အတိုင်း
    </button>
  </form>
</div>