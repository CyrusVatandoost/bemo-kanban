<template>
    <div class="card">
        <span> {{ card.column_id }} {{ card.title }} - {{ card.order }} </span>
    </div>
</template>

<script>
export default {
    props: {
        card: Object,
    },
};
</script>
