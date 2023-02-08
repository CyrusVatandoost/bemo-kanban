<template>
    <div class="main">
        <div class="justify-between padding">
            <div>
                <h1 class="title">Kanban Board</h1>
                <h2 class="subtitle">
                    A simple kanban board app built with Laravel and Vue 2 by
                    <a href="https://cyrusvatandoost.com" target="_blank">
                        Cyrus Vatandoost
                    </a>
                </h2>
            </div>
            <div>
                <a class="button" href="/export"> Export Board </a>
            </div>
        </div>
        <div class="board">
            <Column
                v-for="column in columns"
                :key="column.id"
                :column="column" />
            <CreateColumnForm />
        </div>
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
