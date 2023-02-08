<template>
    <div>
        <div class="column-container">
            <Column
                v-for="column in columns"
                :key="column.id"
                :column="column" />
            <CreateColumnForm />
        </div>
        <Link class="button" href="/export" method="post" as="button">
            Export
        </Link>
    </div>
</template>

<script>
import Column from "@/Components/Column.vue";
import CreateColumnForm from "@/Components/CreateColumnForm.vue";
import { Link } from "@inertiajs/vue2";

export default {
    components: {
        Column,
        CreateColumnForm,
        Link,
    },
    props: {
        columns: Array,
    },
};
</script>
