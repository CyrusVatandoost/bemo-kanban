<template>
    <div class="card">
        <span>
            {{ card.title }}
        </span>
    </div>
</template>

<script>
export default {
    props: {
        card: Object,
    },
};
</script>
