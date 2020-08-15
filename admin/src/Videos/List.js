import React from "react";
import {
    Datagrid,
    EditButton,
    List,
    TextField,
} from 'react-admin';

export const VideoList = (props) => (
    <List
        {...props}
        sort={{ field: 'id', order: 'ASC' }}
        bulkActionButtons={false}
        title="Liste des vidéos"
        perPage={25}
    >
        <Datagrid>
            <TextField source="abstract" label="Description" />
            <EditButton />
        </Datagrid>
    </List>
);

