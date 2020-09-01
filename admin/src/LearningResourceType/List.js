import React from "react";
import {
    Datagrid,
    EditButton,
    List,
    TextField,
} from 'react-admin';

export const LearningResourceTypeList = (props) => (
    <List
        {...props}
        sort={{ field: 'id', order: 'ASC' }}
        bulkActionButtons={false}
        title="Liste des types de supports ou de talks"
        perPage={25}
    >
        <Datagrid>
            <TextField source="name" label="Label" />
            <TextField source="abstract" label="Description" />
            <TextField source="typeFor" label="S'applique sur" />
            <EditButton />
        </Datagrid>
    </List>
);

