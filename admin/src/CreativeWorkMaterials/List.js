import React from "react";
import {
    Datagrid,
    EditButton,
    List,
    TextField,
    ReferenceField,
    UrlField,
} from 'react-admin';


export const CreativeWorkMaterialList = (props) => (
    <List
        {...props}
        sort={{ field: 'name', order: 'ASC' }}
        bulkActionButtons={false}
        title="Liste des supports de présentation"
        perPage={25}
    >
        <Datagrid>
            <TextField source="abstract" label="Description" />
            <ReferenceField label="Type de support" source="learningResourceType" reference="learning_resource_types">
                <TextField source="name" />
            </ReferenceField>
            <UrlField source="contentUrl" label="Lien" />
            <ReferenceField label="Support du talk" source="encodesCreativeWork" reference="creative_works">
                <TextField source="name" />
            </ReferenceField>
            <EditButton />
        </Datagrid>
    </List>
);

