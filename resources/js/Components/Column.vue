<template>
    <div>
        <span>
            {{ column.title }}
        </span>
    </div>
</template>

<script>
export default {
    props: {
        column: Object,
    },
};
</script>
