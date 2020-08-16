import React from 'react';
import { Create, SimpleForm, TextInput, ReferenceInput, SelectInput, required } from 'react-admin';

export const CreativeWorkMaterialCreate = (props) => (
    <Create {...props} title="Création d'un support de présentation">
        <SimpleForm>
            <TextInput
                fullWidth
                label="Description"
                source="abstract"
                validate={required()}
            />
            <ReferenceInput
                label="Type de support"
                source="learningResourceType"
                reference="learning_resource_types"
                filter={{ typeFor: 'creativeWorkMaterial' }}
            >
                <SelectInput optionText="name" />
            </ReferenceInput>
            <TextInput
                fullWidth
                label="Url du support"
                source="contentUrl"
                validate={required()}
            />
            <ReferenceInput label="Talk du support" source="encodesCreativeWork" reference="creative_works">
                <SelectInput optionText="name" />
            </ReferenceInput>
        </SimpleForm>
    </Create>
);
