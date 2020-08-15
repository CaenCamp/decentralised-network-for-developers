import React from "react";
import {
    Datagrid,
    EditButton,
    List,
    TextField,
    UrlField,
    ReferenceField
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
            <UrlField source="contentUrl" label="Lien" />
            <UrlField source="embedUrl" label="Lien embed" />
            <ReferenceField label="Support du talk" source="encodesCreativeWork" reference="creative_works">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField label="Enregistré au meetup" source="recordedAt" reference="events">
                <TextField source="name" />
            </ReferenceField>
            <EditButton />
        </Datagrid>
    </List>
);

