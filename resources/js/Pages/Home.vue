<template>
    <div class="column-container">
        <Column v-for="column in columns" :key="column.id" :column="column" />
        <CreateColumnForm />
    </div>
</template>

<script>
import Column from "@/Components/Column.vue";
import CreateColumnForm from "@/Components/CreateColumnForm.vue";

export default {
    components: {
        Column,
        CreateColumnForm,
    },
    props: {
        columns: Array,
    },
};
</script>
