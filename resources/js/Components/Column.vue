<template>
    <div>
        <span>
            {{ column.title }}
        </span>
        <DeleteColumnButton :columnId="column.id" />
        <div>
            <div v-for="card in column.cards" :key="card.id">
                {{ card.title }}
            </div>
        </div>
        <CreateCardForm :columnId="column.id" />
    </div>
</template>

<script>
import CreateCardForm from "./CreateCardForm.vue";
import DeleteColumnButton from "./DeleteColumnButton.vue";

export default {
    components: { CreateCardForm, DeleteColumnButton },
    props: {
        column: Object,
    },
};
</script>
