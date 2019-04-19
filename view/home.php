<h1>WOLOLO <?= $this->thing ?></h1>

<form method="POST" enctype="application/json">
    <label for="thing">
        Thing:
        <input type="text" id="thing" name="thing" required />
    </label>
    <input type="submit" />
</form>

<pre id="output"></pre>

<script>
const form = document.querySelector('form');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const thing = form.thing.value;

    const response = await fetch('/', {
        method: 'POST',
        body: JSON.stringify({ thing }),
        headers: {
            'Content-Type': 'application/json',
        },
    });

    if (!response.ok) {
        alert(response.statusText);
    }

    document.querySelector('#output').innerText = await response.text();
});
</script>

<pre>
<?php
if (\is_iterable($this->request)) {
    foreach ($this->request as $thing) {
        echo $thing, PHP_EOL;
    }
} else {
    var_dump($this->request);
}
?>
</pre>
