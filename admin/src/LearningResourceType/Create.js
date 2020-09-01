import React from 'react';
import { Create, SimpleForm, TextInput, SelectInput, required } from 'react-admin';

import { typeForChoices } from './index';

export const LearningResourceTypeCreate = (props) => (
    <Create {...props} title="Créer un nouveau type pour les talks ou les supports">
        <SimpleForm>
            <TextInput
                fullWidth
                label="Label"
                source="name"
                validate={required()}
            />
            <TextInput
                fullWidth
                label="Description"
                source="abstract"
                validate={required()}
            />
            <SelectInput source="typeFor" label= "Applicable à" choices={typeForChoices} />
        </SimpleForm>
    </Create>
);
