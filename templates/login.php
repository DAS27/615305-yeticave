<form class="form container <?= count($errors) ? 'form--invalid' : ''; ?>" action="login.php" method="post"> <!-- form--invalid -->
    <h2>Вход</h2>
    <div class="form__item <?= isset($errors['email']) ? 'form__item--invalid' : ''; ?>"> <!-- form__item--invalid -->
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail">
      <span class="form__error">
          <?php if(isset($errors['email'])): ?>
          <?= $errors['email']; ?>
          <?php endif; ?>
       </span>
    </div>
    <div class="form__item <?= isset($errors['password']) ? 'form__item--invalid' : ''; ?> form__item--last">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" placeholder="Введите пароль">
      <span class="form__error">
        <?php if(isset($errors['password'])): ?>
        <?= $errors['password']; ?>
        <?php endif; ?>
      </span>
    </div>
    <button type="submit" class="button">Войти</button>
  </form>
