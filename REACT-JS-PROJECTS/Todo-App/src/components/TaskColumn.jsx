import React from 'react'
import "./TaskColumn.css"
import TaskCard from './TaskCard'

// const TaskColumn = (propsDatas) => {
//     // console.log(Todo);
//     return (
//         <section className='task_column'>
//             <h2 className='task_column_heading'>
//                 <img className='task_column_icon' src={propsDatas.icon} />
//                 {propsDatas.taskColumnName}
//             </h2>
//         </section>
//     )
// }

// Another logic of using props in directly object

const TaskColumn = ({taskColumnName, icon, tasks, status, handleDelete}) => {
    // console.log(Todo);
    // const {taskColumnName, icon} = propsDatas
    return (
        <section className='task_column'>
            <h2 className='task_column_heading'>
                <img className='task_column_icon' src={icon} />
                {taskColumnName}
            </h2>

            {
                tasks.map((task, index) => task.status === status && (
                <TaskCard 
                    key={index} 
                    title={task.task} 
                    tags={task.tags} 
                    handleDelete={handleDelete}
                    index={index}
                />
            )
            )}
        </section>
    )
}

export default TaskColumn