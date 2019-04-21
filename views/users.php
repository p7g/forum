<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Forum
      </h1>
      <h2 class="subtitle">
        But not old and lame
      </h2>
    </div>
  </div>
</section>
<section class="section">
  <div class="container">
    <form method="POST">
      <legend>New user</legend>

      <div class="form-group">
        <label class="form-label" for="name">
          Username:
        </label>
        <input class="form-input" type="text" id="name" name="name" />
      </div>
      <div class="form-group">
        <label class="form-label" for="email">
          Email:
        </label>
        <input class="form-input" type="email" id="email" name="email" />
      </div>
      <div class="form-group">
        <label class="form-label" for="signature">
          Signature:
        </label>
        <textarea class="form-input" id="signature" name="signature"></textarea>
      </label>
      <div class="form-group">
        <label class="form-label" for="date">
          Date of birth:
        </label>
        <input class="form-input" type="date" id="date" name="date_of_birth" />
      </label>

      <input class="btn btn-link" type="submit" />
    </form>

    <?php foreach ($this->users as $user): ?>
      <div class="tile">
        <div class="tile-icon">
          <div class="example-tile-icon">
            <i class="icon icon-file centered"></i>
          </div>
        </div>
        <div class="tile-content">
          <div class="tile-title"><?= $user->get_name() ?></div>
          <div class="tile-subtitle"><?= $user->get_signature() ?></div>
        </div>
        <div class="tile-action">
          <button class="btn btn-link">
            <i class="icon icon-more-vert"></i>
          </button>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</section>
