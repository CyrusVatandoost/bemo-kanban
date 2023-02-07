<template>
    <div>
        <span>
            {{ column.title }}
        </span>
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

export default {
    components: { CreateCardForm },
    props: {
        column: Object,
    },
};
</script>
