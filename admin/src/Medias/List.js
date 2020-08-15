import React from "react";
import {
    Datagrid,
    EditButton,
    List,
    TextField,
} from 'react-admin';


export const MediaList = (props) => (
    <List
        {...props}
        sort={{ field: 'name', order: 'ASC' }}
        bulkActionButtons={false}
        title="Liste des supports de présentation"
        perPage={25}
    >
        <Datagrid>
            <TextField source="abstract" label="Description" />
            <EditButton />
        </Datagrid>
    </List>
);

